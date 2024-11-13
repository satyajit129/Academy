<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\SubjectSubTopic;
use App\Models\SubjectTopic;
use App\Traits\DateTimeFormatterTrait;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class CustomExamsController extends Controller
{
    use Slugger;
    use DateTimeFormatterTrait;
    public function customExamsList()
    {
        $custom_exams = CustomExam::where('status', 1)->latest()->get();
        return view('backend.pages.custom-exams.list', compact('custom_exams'));
    }

    public function customExamsCreate()
    {
        $subjects = Subject::where('status', 1)->with('questions')->get();
        $lessons = SubjectLesson::where('status', 1)->get();
        $topics = SubjectTopic::where('status', 1)->get();
        $sub_topics = SubjectSubTopic::where('status', 1)->get();
        return view('backend.pages.custom-exams.create', compact('subjects', 'lessons', 'topics', 'sub_topics'));
    }

    public function getMultipleSubjectLessons(Request $request)
    {
        $id = $request->subject_ids;
        $subject_lessons = SubjectLesson::whereIn('subject_id', $id)->with('questions')->get();
        return response()->json($subject_lessons);
    }

    public function getMultipleSubjectTopics(Request $request)
    {
        $id = $request->lesson_ids;
        $subject_topics = SubjectTopic::whereIn('lesson_id', $id)->with('questions')->get();
        return response()->json($subject_topics);
    }
    public function getMultipleSubjectSubTopics(Request $request)
    {
        $id = $request->topic_ids;
        $subject_sub_topics = SubjectSubTopic::whereIn('topic_id', $id)->with('questions')->get();
        return response()->json($subject_sub_topics);
    }

    public function storeQuestionsByCategory(Request $request, $category)
    {
        // dd($request->all());
        $exam_type = $request->input('exam_type');
        $exam_name = $request->input('name');
        $number_of_questions = $request->input('number_of_questions');

        $questions_by_category = [];
        $total_number_of_questions = 0;
        $author_id = Auth::user()->id;

        foreach ($number_of_questions as $category_id => $question_limit) {
            if (is_null($question_limit)) {
                continue;
            }
            $questions = Question::where($category . '_id', $category_id)
                ->inRandomOrder()
                ->limit($question_limit)
                ->get();

            $questions_by_category[$category_id] = $questions;
            $total_number_of_questions += $question_limit;
        }
        $start_datetime = $this->formatDateTime($request->start_datetime);
        $end_datetime = $this->formatDateTime($request->end_datetime);
        $slug = $this->generateUniqueSlug($exam_name, CustomExam::class);
        $passing_marks = $this->calculatePassingMark($total_number_of_questions);
        $create_custom_exam = CustomExam::create([
            'name' => $exam_name,
            'slug' => $slug,
            'exam_type' => $exam_type,
            'exam_taker' => $author_id,
            'number_of_questions' => $total_number_of_questions,
            'passing_marks' => $passing_marks,
            'start_datetime' => $start_datetime,
            'end_datetime' => $end_datetime,
        ]);
        if ($create_custom_exam) {
            $this->saveQuestions($questions_by_category, $create_custom_exam->id);
        }

        return redirect()->route('customExamsList')->with('success', 'Custom Exam created successfully');
    }

    public function storeSubjectWiseQuestions(Request $request)
    {
        $this->validateNumberOfQuestions($request);
        if (empty(array_filter($request->input('number_of_questions')))) {
            return redirect()->back()->with('error', 'You cannot create an empty custom exam');
        }
        return $this->storeQuestionsByCategory($request, 'subject');
    }

    public function storeLessonWiseQuestions(Request $request)
    {
        $this->validateNumberOfQuestions($request);
        if (empty(array_filter($request->input('number_of_questions')))) {
            return redirect()->back()->with('error', 'You cannot create an empty custom exam');
        }
        return $this->storeQuestionsByCategory($request, 'lesson');
    }

    public function storeTopicWiseQuestions(Request $request)
    {
        $this->validateNumberOfQuestions($request);
        if (empty(array_filter($request->input('number_of_questions')))) {
            return redirect()->back()->with('error', 'You cannot create an empty custom exam');
        }
        return $this->storeQuestionsByCategory($request, 'topic');
    }

    public function storeSubTopicWiseQuestions(Request $request)
    {
        $this->validateNumberOfQuestions($request);
        if (empty(array_filter($request->input('number_of_questions')))) {
            return redirect()->back()->with('error', 'You cannot create an Empty Custom Exam');
        }
        return $this->storeQuestionsByCategory($request, 'sub_topic');
    }

    protected function validateNumberOfQuestions(Request $request)
    {
        $request->validate([
            'number_of_questions' => 'required|array',
            'number_of_questions.*' => 'nullable|numeric|min:1',
        ]);

    }

    private function calculatePassingMark($number_of_question)
    {
        return (int) ($number_of_question * 0.4);
    }

    private function saveQuestions($questions, $exam_id)
    {
        $questions_to_save = [];

        foreach ($questions as $subject_id => $subject_questions) {
            foreach ($subject_questions as $question) {
                $questions_to_save[] = [
                    'custom_exam_id' => $exam_id,
                    'question_id' => $question->id,
                ];
            }
        }

        if (count($questions_to_save) > 0) {
            DB::table('custom_exam_question')->insert($questions_to_save);
        }
    }
    public function customExamsViewQuestions($id)
    {
        $custom_exam = CustomExam::with(['questions.options'])->find($id);
        return view('backend.pages.custom-exams.view-questions', compact('custom_exam'));
    }
    

}
