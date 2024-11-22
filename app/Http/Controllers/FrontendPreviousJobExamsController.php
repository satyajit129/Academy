<?php

namespace App\Http\Controllers;

use App\Models\PreviousExam;
use App\Models\PreviousExamCategory;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class FrontendPreviousJobExamsController extends Controller
{
    public function previousJobExams(Request $request)
    {
        $query = PreviousExam::with('questions', 'category')
            ->where('status', 1)
            ->whereHas('questions');

        // Check for category filter
        if ($request->has('category')) {
            $decrypted_id = decrypt($request->category);
            $query->where('category_id', $decrypted_id);
        }

        $previous_job_exams = $query->paginate(2);
        $others_jobs_categories = PreviousExamCategory::where('status', 1)
            ->whereHas('previousExams', function ($query) {
                $query->where('status', 1);
            })
            ->get();
        return view('custom.pages.previous_exam.previous_exam_list', compact('previous_job_exams', 'others_jobs_categories'));
    }

    public function previousJobExamsQuestion($slug, $id)
    {
        $decrypted_id = decrypt($id);
        $decrypted_slug = decrypt($slug);

        // Load the exam with paginated questions
        $previous_job_exam = PreviousExam::with(['category', 'questions'])
            ->where('slug', $decrypted_slug)
            ->where('id', $decrypted_id)
            ->first();

        $related_exams = PreviousExam::with('category', 'questions')
            ->where('status', 1)
            ->whereHas('questions')
            ->where('id', '!=', $previous_job_exam->id)
            ->where('category_id', $previous_job_exam->category_id)
            ->limit(10)
            ->inRandomOrder()
            ->get();

        return view('custom.pages.previous_exam.previous_exam_question_list', compact('previous_job_exam', 'related_exams'));
    }

    public function previousJobExamsSearch(Request $request)
    {
        $queryInput = $request->input('query');

        $previous_job_exams = PreviousExam::with('questions', 'category')
            ->where('status', 1)
            ->whereHas('questions')
            ->where(function ($queryBuilder) use ($queryInput) {
                $queryBuilder->where('name', 'like', '%' . $queryInput . '%')
                    ->orWhereHas('category', function ($categoryQuery) use ($queryInput) {
                        // Search in category name
                        $categoryQuery->where('name', 'like', '%' . $queryInput . '%');
                    });
            })
            ->paginate(2);


        return view('custom.pages.previous_exam.partials.exam_list', compact('previous_job_exams'))->render();
    }
    public function previousJobExamsStartExam($id)
    {
        $decrypted_id = decrypt($id);
        $previous_job_exam = PreviousExam::with('questions.options', 'category')->find($decrypted_id);
        // dd($previous_job_exam);
        return view('custom.pages.previous_exam.start-exam', compact('previous_job_exam'));
    }
    public function previousJobExamSubmit(Request $request)
    {
        
        $answers = $request->input('answers');
        $previous_job_exam = PreviousExam::with('questions.options', 'category')->find($request->previous_exam_id);

        // Initialize scoring variables
        $total_marks = $request->input('total_marks');
        $correct_answers = 0;
        $incorrect_answers = 0;
        $score = 0;

        // Array to hold question details with selected and correct answers
        $questions_details = [];

        // Loop through each question and check the answer
        foreach ($answers as $question_id => $answer_id) {
            $question = Question::with('options')->find($question_id);

            if ($question) {
                $is_correct = false;
                $correct_option_id = null;

                // Check each option to find the correct answer
                foreach ($question->options as $option) {
                    if ($option->is_correct) {
                        $correct_option_id = $option->id;
                    }
                    if ($option->is_correct && $option->id == $answer_id) {
                        $is_correct = true;
                        $correct_answers++;
                        break;
                    }
                }

                if (!$is_correct) {
                    $incorrect_answers++;
                }

                // Store question details
                $questions_details[] = [
                    'question' => $question,
                    'selected_answer' => $answer_id,
                    'correct_answer' => $correct_option_id,
                    'is_correct' => $is_correct,
                ];
            } else {
                $incorrect_answers++;
            }
        }

        $score = $correct_answers;

        return $this->previousJobExamSolution(
            $previous_job_exam,
            $total_marks,
            $correct_answers,
            $incorrect_answers,
            $previous_job_exam->negative_mark,
            $score,
            $questions_details
        );
    }

    public function previousJobExamSolution($previous_job_exam, $total_marks, $correct_answers, $incorrect_answers, $negative_mark, $score, $questions_details)
    {
        return view('custom.pages.previous_exam.exam-solution-with-result', [
            'previous_job_exam' => $previous_job_exam,
            'total_marks' => $total_marks,
            'correct_answers' => $correct_answers,
            'incorrect_answers' => $incorrect_answers,
            'negative_mark' => $negative_mark,
            'score' => $score,
            'questions_details' => $questions_details,
        ]);
    }


}
