<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use App\Models\CustomExamResult;
use App\Models\Question;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{


    public function exams()
    {
        $top_performers = CustomExamResult::select('user_id', DB::raw('SUM(total_marks) as total_marks'))
            ->with('userInfo')
            ->groupBy('user_id')
            ->orderBy('total_marks', 'desc')
            ->limit(10)
            ->get();
        $custom_exams = $this->getExamsQuery()->paginate(2);
        return view('custom.pages.exam.exams', compact('custom_exams', 'top_performers'));
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
        // dd($request->all());
        try {
            $validated = $request->validate(
                [
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
                ],
                [
                    'answers.required' => 'উত্তরপত্র জমা দিতে আপনাকে কমপক্ষে একটি প্রশ্নের উত্তর করতে হবে।'
                ]
            );


            $user_id = Auth::user()->id;
            $custom_exam_id = $request->custom_exam_id;

            // Fetch the user's exam result
            $exam_result = CustomExamResult::where('user_id', $user_id)
                ->where('custom_exam_id', $custom_exam_id)
                ->first();
            $custom_exam_info = CustomExam::find($custom_exam_id);
            $check_question = $this->checkQuestions($request->answers);
            $total_marks_data = $this->getTotalMarks($check_question, $custom_exam_info->negative_marks, $custom_exam_info->number_of_questions);
            $max_attempts = 3;
            if ($exam_result) {
                if ($exam_result->attempts >= $max_attempts) {
                    return response()->json([
                        'message' => 'আপনি ইতিমধ্যে সর্বোচ্চ ৩ বার প্রচেষ্টা সম্পন্ন করে ফেলেছেন।',
                    ], 400);
                }

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
            Log::info($e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            return response()->json(['errors' => $ex->getMessage()], 200);
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
    private function getAllPerformersQuery()
    {
        return CustomExamResult::select('user_id')
            ->with('userInfo')
            ->selectRaw('SUM(total_marks) as total_marks')
            ->selectRaw('SUM(total_correct) as total_correct')
            ->selectRaw('SUM(total_wrong) as total_wrong')
            ->selectRaw('SUM(total_answered) as total_answered')
            ->groupBy('user_id')
            ->orderByDesc('total_marks');
    }
    public function seeAllPerformer(Request $request)
    {
        $all_performers = $this->getAllPerformersQuery()->paginate(10);
        return view('custom.pages.exam.all_performers', compact('all_performers'));
    }

    public function seeAllPerformerData(Request $request)
    {
        $all_performers = $this->getAllPerformersQuery()->paginate(10);
        return view('custom.pages.exam.partials.all_performers_list', compact('all_performers'))->render();
    }

}
