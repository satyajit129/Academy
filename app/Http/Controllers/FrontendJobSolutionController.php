<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\SubjectSubTopic;
use App\Models\SubjectTopic;
use App\Models\UserCustomExam;
use App\Models\UserCustomExamQuestion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mpdf\Tag\Th;
use Throwable;

class FrontendJobSolutionController extends Controller
{
    public function jobSolution()
    {
        $subjects = Subject::with('questions')
            ->where('status', 1)
            ->whereHas('questions')
            ->get();

        return view('custom.pages.job_solution.job_solution', compact('subjects'));
    }

    public function jobSolutionSubjectWise($slug, $id)
    {
        $decrypted_id = decrypt($id);
        $decrypted_slug = decrypt($slug);
        $subject = Subject::with('questions', 'lessons.topics.subTopics')
            ->where('slug', $decrypted_slug)
            ->where('id', $decrypted_id)
            ->first();

        $subjects = Subject::where('status', 1)->with('questions')
        ->where('id', '!=', $subject->id)
            ->whereHas('questions')
            ->get();

        return view('custom.pages.job_solution.subject_wise', compact('subject', 'subjects'));
    }

    public function subjectWiseQuestions($subject_id)
    {
        $subject_id = decrypt($subject_id);
        $questions = Question::where('subject_id', $subject_id)
            ->with('options', 'subject')
            ->paginate(10);

        $subject_info = Subject::where('id', $subject_id)
            ->first();

        return view('custom.pages.job_solution.dynamic_query_wise_questions', compact('questions', 'subject_info'));
    }

    public function lessonWiseQuestions($lesson_id, $subject_id, )
    {
        $subject_id = decrypt($subject_id);
        $lesson_id = decrypt($lesson_id);
        $questions = Question::where('subject_id', $subject_id)
            ->where('lesson_id', $lesson_id)
            ->with('options', 'subject')
            ->paginate(10);

        $subject_info = Subject::where('id', $subject_id)
            ->first();

        $lesson_info = SubjectLesson::where('id', $lesson_id)
            ->first();

        return view('custom.pages.job_solution.dynamic_query_wise_questions', compact('questions', 'subject_info', 'lesson_info'));
    }

    public function topicWiseQuestions($topic_id, $lesson_id, $subject_id, )
    {
        $subject_id = decrypt($subject_id);
        $lesson_id = decrypt($lesson_id);
        $topic_id = decrypt($topic_id);
        $questions = Question::where('subject_id', $subject_id)
            ->where('lesson_id', $lesson_id)
            ->where('topic_id', $topic_id)
            ->with('options', 'subject')
            ->paginate(10);

        $subject_info = Subject::where('id', $subject_id)
            ->first();

        $lesson_info = SubjectLesson::where('id', $lesson_id)
            ->first();

        $topic_info = SubjectTopic::where('id', $topic_id)
            ->first();

        return view('custom.pages.job_solution.dynamic_query_wise_questions', compact('questions', 'subject_info', 'lesson_info', 'topic_info'));
    }

    public function subTopicWiseQuestions($sub_topic_id, $topic_id, $lesson_id, $subject_id)
    {
        $subject_id = decrypt($subject_id);
        $lesson_id = decrypt($lesson_id);
        $topic_id = decrypt($topic_id);
        $sub_topic_id = decrypt($sub_topic_id);
        $questions = Question::where('subject_id', $subject_id)
            ->where('lesson_id', $lesson_id)
            ->where('topic_id', $topic_id)
            ->where('sub_topic_id', $sub_topic_id)
            ->with('options', 'subject')
            ->paginate(10);

        $subject_info = Subject::where('id', $subject_id)
            ->first();

        $lesson_info = SubjectLesson::where('id', $lesson_id)
            ->first();

        $topic_info = SubjectTopic::where('id', $topic_id)
            ->first();

        $sub_topic_info = SubjectSubTopic::where('id', $sub_topic_id)
            ->first();

        return view('custom.pages.job_solution.dynamic_query_wise_questions', compact('questions', 'subject_info', 'lesson_info', 'topic_info', 'sub_topic_info'));
    }

    public function startExam(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'numberOfQuestions' => 'required|integer|min:2',
            'totalMarks' => 'required|integer',
            'cutMarks' => 'required|integer|min:1',
            'negativeMarks' => 'required',
            'examDuration' => 'required|integer',
            'question_ids' => 'required',
        ]);

        try {
            $numberOfQuestions = $request->numberOfQuestions;
            $totalMarks = $request->totalMarks;
            $cutMarks = $request->cutMarks;
            $negativeMarks = $request->negativeMarks;
            $examDuration = $request->examDuration;

            // Decode the JSON array of question IDs
            $questionIds = json_decode($request->question_ids, true);

            $questions = Question::with('options')
                ->whereIn('id', $questionIds)
                ->inRandomOrder()
                ->limit($numberOfQuestions)
                ->get();

            // Pass data to the view
            return view('custom.pages.job_solution.start_exam', compact('numberOfQuestions', 'totalMarks', 'cutMarks', 'negativeMarks', 'examDuration', 'questions'));
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function submitExam(Request $request)
    {
        // dd($request->negative_marks);
        try {
            $validated = $request->validate([
                'total_marks' => 'required|numeric',
                'cut_marks' => 'required|numeric',
                'negative_marks' => 'required|numeric',
                'final_score' => 'nullable|numeric',
                'answers' => 'nullable|array',
                'answers.*' => 'nullable',
                'question_ids' => 'required|json',
            ]);

            $current_date_time = Carbon::now();
            $user_id = Auth::user()->id;

            $user_custom_exam = UserCustomExam::create([
                'user_id' => $user_id,
                'total_marks' => $request->total_marks,
                'cut_marks' => $request->cut_marks,
                'final_score' => $request->final_score,
                'exam_date_time' => $current_date_time,
            ]);
            if ($user_custom_exam) {
                $all_questions = json_decode($request->question_ids);
                $this->saveUserCustomQuestions($request, $user_custom_exam->id, $all_questions, $request->negative_marks);
            }
            return redirect()->route('myExam')->with('success', 'Exam submitted successfully.');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('submitExam')->with('error', $e->getMessage());
        }
    }

    private function saveUserCustomQuestions($request, $user_custom_exam_id, $all_questions, $negative_marks)
    {
        $user_custom_questions = [];
        $total_correct = 0;
        $total_wrong = 0;
        $total_answered = 0;

        foreach ($all_questions as $question_id) {

            $user_answer = isset($request->answers[$question_id]) ? $request->answers[$question_id] : null;
            $correct_answer = $this->getCorrectAnswer($question_id);

            // Initialize $is_correct before checking the answer
            $is_correct = false;

            if ($user_answer !== null) {
                $is_correct = $user_answer == $correct_answer;
                if ($is_correct) {
                    $total_correct++;
                } else {
                    $total_wrong++;
                }
                $total_answered++;
            }

            Log::info($correct_answer);

            $user_custom_questions[] = [
                'user_custom_exam_id' => $user_custom_exam_id,
                'question_id' => $question_id,
                'user_answer' => $user_answer,
                'is_correct' => $is_correct,
                'correct_answer' => $correct_answer
            ];

        }

        // Insert the answers into the UserCustomExamQuestion table
        UserCustomExamQuestion::insert($user_custom_questions);

        // Calculate total score and negative marks
        $total_negative_marks = $total_wrong * $negative_marks;
        $total_score = $total_correct - $total_negative_marks;

        // Update the UserCustomExam table with the final scores
        UserCustomExam::where('id', $user_custom_exam_id)
            ->update([
                'total_answered' => $total_answered,
                'total_wrong' => $total_wrong,
                'negative_marks' => $total_negative_marks,
                'total_correct' => $total_correct,
                'final_score' => $total_score
            ]);

        return true;
    }


    private function getCorrectAnswer($question_id)
    {
        $question = Question::with('options')->find($question_id);

        foreach ($question->options as $option) {
            if ($option->is_correct) {
                return $option->id;
            }
        }
    }

    public function singleQuestion($slug, $id)
    {
        // Decrypt the ID to retrieve the original question
        $dycrypted_id = decrypt($id);
        $question = Question::with('options', 'subjectLesson', 'subjectTopic', 'subjectSubTopic')->find($dycrypted_id);

        $questionsByLesson = Question::with('subjectLesson')
            ->where('lesson_id', $question->subjectLesson->id)
            ->where('id', '!=', $dycrypted_id)
            ->limit(4)
            ->get();

        $questionsByTopic = Question::with('subjectTopic')
            ->where('topic_id', $question->subjectTopic->id)
            ->where('id', '!=', $dycrypted_id)
            ->limit(4)
            ->get();
        $questionsBySubTopic = Question::with('subjectSubTopic')
            ->where('sub_topic_id', $question->subjectSubTopic->id)
            ->where('id', '!=', $dycrypted_id)
            ->limit(4)
            ->get();

        $relatedQuestions = $questionsByLesson->merge($questionsByTopic)->merge($questionsBySubTopic);
        $relatedQuestions = $relatedQuestions->shuffle();
        $relatedQuestions = $relatedQuestions->take(12);
        // dd($relatedQuestions);
        return view('custom.pages.job_solution.single_question', compact('question', 'relatedQuestions'));
    }

}

