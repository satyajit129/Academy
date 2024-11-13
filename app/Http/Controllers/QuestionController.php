<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\SubjectSubTopic;
use App\Models\SubjectTopic;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class QuestionController extends Controller
{
    use Slugger;
    public function questionList()
    {
        $questions = Question::with('subjectTopic', 'subject', 'subjectLesson', 'options', 'subjectSubTopic')->get();
        // dd($questions);
        return view('backend.pages.question.list', compact('questions'));
    }
    public function questionCreate()
    {
        $subjects = Subject::where('status', 1)->get();
        $subject_lessons = SubjectLesson::where('status', 1)->get();
        $subject_topics = SubjectTopic::where('status', 1)->get();
        $subject_sub_topics = SubjectSubTopic::where('status', 1)->get();
        $question_types = QuestionType::all();
        return view('backend.pages.question.create', compact('subjects', 'subject_lessons', 'subject_topics', 'question_types', 'subject_sub_topics'));
    }
    public function getSubjectTopics(Request $request)
    {
        $id = $request->lesson_id;
        $subject_topics = SubjectTopic::where('lesson_id', $id)->get();
        return response()->json($subject_topics);
    }
    public function getSubjectSubTopics(Request $request)
    {
        $id = $request->topic_id;
        $subject_sub_topics = SubjectSubTopic::where('topic_id', $id)->get();
        return response()->json($subject_sub_topics);
    }
    public function getQuestions(Request $request)
    {
        $filters = [
            'subject_id' => $request->subject_id,
            'lesson_id' => $request->lesson_id,
            'topic_id' => $request->topic_id,
            'sub_topic_id' => $request->sub_topic_id,
        ];
        $questions = Question::filterQuestions($filters);
        return response()->json($questions);
    }
    public function questionStore(Request $request, $id = null)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'question_text' => 'required',
                'subject_id' => 'required',
                'lesson_id' => 'required',
                'topic_id' => 'required',
                'sub_topic_id' => 'required',
                'marks' => 'required|integer|min:1',
                'options' => 'required|array',
                'correct_option' => 'required',
                'meta_tags' => 'required',
                'meta_description' => 'required',
            ]);
            $question = $id ? Question::findOrFail($id) : new Question();

            $slug = $this->generateUniqueSlug($request->question_text, Question::class);
            $question->slug = $slug;

            $question->question_text = $request->question_text;
            $question->subject_id = $request->subject_id;
            $question->lesson_id = $request->lesson_id;
            $question->topic_id = $request->topic_id;
            $question->sub_topic_id = $request->sub_topic_id;
            $question->marks = $request->marks;
            $question->meta_tags = $request->meta_tags;
            $question->meta_description = $request->meta_description;
            $question->save();
            if ($id) {
                $question->options()->delete();
            }
            foreach ($request->options as $index => $optionText) {
                if ($optionText) {
                    Option::create([
                        'question_id' => $question->id,
                        'option_text' => $optionText,
                        'is_correct' => $index == $request->correct_option
                    ]);
                }
            }
            DB::commit();
            $message = $id ? 'Question updated successfully.' : 'Question saved successfully.';
            return redirect()->back()->with('success', $message);

        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function questionEdit($id)
    {
        $question = Question::with('options')->find($id);
        $subjects = Subject::where('status', 1)->get();
        $subject_lessons = SubjectLesson::where('status', 1)->get();
        $subject_topics = SubjectTopic::where('status', 1)->get();
        $question_types = QuestionType::all();
        return view('backend.pages.question.edit', compact('question', 'subjects', 'subject_lessons', 'subject_topics', 'question_types'));
    }

    public function questionDelete($id)
    {
        try {
            DB::beginTransaction();
            $question = Question::find($id);
            $question->status = 0;
            $question->save();
            if ($id) {
                $question->options()->delete();
            }
            DB::commit();
            return redirect()->back()->with('success', 'Question deleted successfully');
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
