<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\SubjectTopic;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Throwable;

class QuestionController extends Controller
{
    use Slugger;
    public function questionList()
    {
        $questions = Question::with( 'subjectTopic')->get();
        return view('backend.pages.question.list', compact('questions'));
    }
    public function questionCreateOrEdit($id = null)
    {
        $subjects = Subject::where('status', 1)->get();
        $subject_lessons = SubjectLesson::where('status', 1)->get();
        $subject_topics = SubjectTopic::where('status', 1)->get();
        $question_types = QuestionType::all();
        if ($id) {
            $question = Question::with('option', 'subjectTopic')->find($id);
            return view('backend.pages.question.create-or-edit', compact('question', 'subjects', 'subject_lessons', 'subject_topics', 'question_types'));
        }
        return view('backend.pages.question.create-or-edit', compact('subjects', 'subject_lessons', 'subject_topics', 'question_types'));
    }
    public function getSubjectTopics(Request $request)
    {
        $id = $request->lesson_id;
        $subject_topics = SubjectTopic::where('lesson_id', $id)->get();
        return response()->json($subject_topics);
    }
    public function questionStore(Request $request, $id = null)
    {
        // dd($request->all());
        try {
            $request->validate([
                'question_type' => 'required|integer|exists:question_types,id',
                'question_text' => 'required',
                'subject_id' => 'required',
                'lesson_id' => 'required',
                'topic_id' => 'required',
                'marks' => 'required|integer|min:1',
                'options' => 'required_if:question_type,1|array',
                'correct_option' => 'required_if:question_type,1|integer',
                'written_ans' => 'required_if:question_type,2|string|nullable'
            ]);
            $slug = $this->generateUniqueSlug($request->question_text, Question::class);
            // Create the question
            $question = new Question();
            $question->question_type = $request->question_type; // Store the numeric ID
            $question->question_text = $request->question_text;
            $question->slug = $slug;
            $question->subject_id = $request->subject_id;
            $question->lesson_id = $request->lesson_id;
            $question->topic_id = $request->topic_id;
            $question->marks = $request->marks;
            $question->save();

            if ($request->question_type == 1) { 
                Option::where('question_id', $question->id)->delete();

                foreach ($request->options as $index => $optionText) {
                    if ($optionText) {
                        Option::create([
                            'question_id' => $question->id,
                            'option_text' => $optionText,
                            'is_correct' => $index == $request->correct_option
                        ]);
                    }
                }
            } elseif ($request->question_type == 2) { 
                Option::create([
                    'question_id' => $question->id,
                    'option_text' => $request->written_ans,
                    'is_correct' => false
                ]);
            }
            return redirect()->back()->with('success', 'Question saved successfully.');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }
}
