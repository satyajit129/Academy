<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use App\Models\CustomExamResult;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ExamController extends Controller
{
    public function exams()
    {
        $custom_exams = $this->getExamsQuery()
            ->paginate(2);

        return view('custom.pages.exam.exams', compact('custom_exams'));
    }

    public function customExamsSearch(Request $request)
    {
        $searchQuery = $request->input('query');

        $custom_exams = $this->getExamsQuery()
            ->when($searchQuery, function ($query, $searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%');
            })
            ->paginate(2);

        return view('custom.pages.exam.partials.exam_list', compact('custom_exams'))->render();
    }

    private function getExamsQuery()
    {
        return CustomExam::with('questions')
            ->where('status', 1)
            ->whereHas('questions')
            ->latest();
    }
    public function customExamsquestions($id, $slug)
    {
        $decrypted_id = decrypt($id);
        $decrypted_slug = decrypt($slug);
        // Load the exam with paginated questions
        $custom_exam_questions = CustomExam::with('questions.options')
            ->where('slug', $decrypted_slug)
            ->where('id', $decrypted_id)
            ->first();

        return view('custom.pages.exam.exam_question_lists', compact('custom_exam_questions'));
    }
    public function customExamSubmit(Request $request)
    {
        try {
            $validated = $request->validate([
                'custom_exam_id' => 'required',
                'answers' => [
                    'required',
                    'array',
                    function ($attribute, $value, $fail) {
                        if (!collect($value)->filter()->count()) {
                            $fail('At least one answer is required.');
                        }
                    },
                ],
                'answers.*' => 'nullable',
            ]);

            $user_id = Auth::user()->id;
            $custom_exam_id = $request->custom_exam_id;

            // Fetch the user's exam result
            $exam_result = CustomExamResult::where('user_id', $user_id)
                ->where('custom_exam_id', $custom_exam_id)
                ->first();

            // Fetch the custom exam details
            $custom_exam_info = CustomExam::find($custom_exam_id);

            // Check the questions and calculate the total marks
            $check_question = $this->checkQuestions($request->answers);
            $total_marks_data = $this->getTotalMarks($check_question, $custom_exam_info->negative_marks, $custom_exam_info->number_of_questions);

            // Maximum allowed attempts
            $max_attempts = 3;

            // If the exam result already exists, check the number of attempts
            if ($exam_result) {
                if ($exam_result->attempts >= $max_attempts) {
                    // Prevent submitting if the maximum number of attempts is reached
                    return response()->json([
                        'message' => 'Maximum attempts reached. You cannot attempt the exam more than 3 times.',
                    ], 400); // 400 Bad Request
                }

                // Otherwise, update the exam result
                $exam_result->update([
                    'attempts' => $exam_result->attempts + 1,
                    'total_marks' => $total_marks_data['total_mark'],
                    'total_answered' => $check_question['total_answered'],
                    'total_correct' => $check_question['total_correct'],
                    'total_wrong' => $check_question['total_wrong'],
                    'is_passed' => $total_marks_data['is_passed'],
                ]);

                return response()->json([
                    'message' => 'Updated successfully',
                    'result' => $exam_result,
                    'user_id' => $user_id,
                    'question_id' => $custom_exam_id,
                    'all_question_with_user_answer' => $check_question['all_question_with_user_answer'],
                ]);
            } else {
                // Create a new exam result if no record exists
                $custom_exam_result_created = CustomExamResult::create([
                    'user_id' => $user_id,
                    'custom_exam_id' => $custom_exam_id,
                    'total_marks' => $total_marks_data['total_mark'],
                    'total_answered' => $check_question['total_answered'],
                    'total_correct' => $check_question['total_correct'],
                    'total_wrong' => $check_question['total_wrong'],
                    'attempts' => 1,
                    'is_passed' => $total_marks_data['is_passed'],
                ]);

                return response()->json([
                    'message' => 'Submitted successfully',
                    'result' => $custom_exam_result_created,
                    'user_id' => $user_id,
                    'question_id' => $custom_exam_id,
                    'all_question_with_user_answer' => $check_question['all_question_with_user_answer'],
                ]);
            }

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    private function checkQuestions($answers)
    {
        $total_correct = $total_wrong = $total_answered = 0;
        $all_question_with_user_answer = [];

        foreach ($answers as $question_id => $user_answer) {
            $correct_answer = $this->getCorrectAnswer($question_id);

            if ($user_answer !== null) {
                if ($user_answer == $correct_answer) {
                    $total_correct++;
                } else {
                    $total_wrong++;
                }
                $total_answered++;

                $all_question_with_user_answer[] = [
                    'question_id' => $question_id,
                    'user_answer' => $user_answer
                ];
            }
        }

        return [
            'total_correct' => $total_correct,
            'total_wrong' => $total_wrong,
            'total_answered' => $total_answered,
            'all_question_with_user_answer' => $all_question_with_user_answer
        ];
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

    private function getTotalMarks($check_question, $negative_marks, $total_questions)
    {
        $total_negative_mark = $check_question['total_wrong'] * $negative_marks;
        $total_mark = $check_question['total_correct'] - $total_negative_mark;
        $pass_mark = $total_questions * 0.4;
        $is_passed = $total_mark >= $pass_mark ? true : false;
        return [
            'total_mark' => $total_mark,
            'is_passed' => $is_passed
        ];
    }
}
