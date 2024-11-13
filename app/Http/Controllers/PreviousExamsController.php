<?php

namespace App\Http\Controllers;

use App\Models\PreviousExam;
use App\Models\PreviousExamCategory;
use App\Models\PreviousExamQuestion;
use App\Models\Question;
use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\Year;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class PreviousExamsController extends Controller
{
    use Slugger;
    public function previousExamsList()
    {
        $previous_exams = PreviousExam::with('category')->where('status', 1)->latest()->get();
        // dd($previous_exams);
        return view('backend.pages.previous-exams.list', compact('previous_exams'));
    }

    public function previousExamsCreateOrEdit($id = null)
    {
        $years = Year::where('status', 1)->get();
        $categories = PreviousExamCategory::where('status', 1)->latest()->get();
        if ($id) {
            $previous_exam = PreviousExam::find($id);
            return view('backend.pages.previous-exams.create-edit', compact('previous_exam', 'years', 'categories'));
        }
        return view('backend.pages.previous-exams.create-edit', compact('years', 'categories'));
    }

    public function previousExamsStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => 'required',
                'category_id' => 'required',
                'negative_mark' => 'required',
                'exam_code' => 'required',
                'year_id' => 'required',
                'exam_date' => 'required',
                'exam_type' => 'required',
                'hours' => 'required|integer|min:0',
                'minutes' => 'required|integer|min:0|max:59',
            ]);
            $total_duration = $request->hours * 60 + $request->minutes;

            $previous_exam = PreviousExam::where('name', $request->name)
                ->where('year_id', $request->year_id)
                ->where('exam_code', $request->exam_code)
                ->where('status', 0)
                ->first();
            if ($previous_exam) {
                $previous_exam->status = 1;
                $previous_exam->save();
                $message = 'Previous Exam reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, PreviousExam::class);
                $previous_exam = $id ? PreviousExam::findOrFail($id) : new PreviousExam();
                $previous_exam->name = $request->name;
                $previous_exam->category_id = $request->category_id;
                $previous_exam->negative_mark = $request->negative_mark;
                $previous_exam->slug = $slug;
                $previous_exam->exam_code = $request->exam_code;
                $previous_exam->year_id = $request->year_id;
                $previous_exam->exam_date = $request->exam_date;
                $previous_exam->exam_type = $request->exam_type;
                $previous_exam->duration = $total_duration;
                $previous_exam->status = 1;
                $previous_exam->save();
                $message = $id ? 'Previous Exam updated successfully' : 'Previous Exam added successfully';
            }
            return redirect()->route('previousExamsList')->with('success', $message);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function previousExamsDelete($id)
    {
        try {
            $previous_exam = PreviousExam::find($id);
            $previous_exam->status = 0;
            $previous_exam->save();
            return redirect()->route('previousExamsList')->with('success', 'Previous Exam deleted successfully');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function assignQuestionsList()
    {
        $previous_exams = PreviousExam::where('status', 1)->latest()->get();

        return view('backend.pages.previous-exams.assign-questions.list', compact('previous_exams'));
    }
    public function assignQuestions($id)
    {
        // dd('okkk');
        $subjects = Subject::where('status', 1)->get();
        $previous_exam = PreviousExam::with('questions')->find($id);
        $questions = Question::where('status', 1)->get();
        $years = Year::where('status', 1)->latest()->get();
        // dd('okkk');
        return view('backend.pages.previous-exams.assign-questions.assign-questions', compact('previous_exam', 'questions', 'subjects', 'years'));
    }
    public function assignQuestionsStore(Request $request)
    {
        try {
            $request->validate([
                'previous_exam_id' => 'required|exists:previous_exams,id',
                'question_ids' => 'required|array',
                'question_ids.*' => 'exists:questions,id',
            ]);
            $previous_exam_id = $request->previous_exam_id;
            $question_ids = $request->question_ids;
            DB::beginTransaction();
            foreach ($question_ids as $question_id) {
                $previous_exam_question = new PreviousExamQuestion();
                $previous_exam_question->exam_id = $previous_exam_id;
                $previous_exam_question->question_id = $question_id;
                $previous_exam_question->save();
            }
            DB::commit();

            return redirect()->back()->with('success', 'Questions assigned successfully');
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }
    }
    public function assignQuestionsDelete($previous_exam_id, $question_id)
    {
        try {
            PreviousExamQuestion::where('exam_id', $previous_exam_id)
                ->where('question_id', $question_id)
                ->delete();
            return redirect()->back()->with('success', 'Question deleted successfully');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $th->getMessage());
        }

    }
    public function previousExamsCategoryList()
    {
        $category_lists = PreviousExamCategory::where('status', 1)->latest()->get();
        return view('backend.pages.previous-exams.category.list', compact('category_lists'));
    }

    public function previousExamsCategoryCreateOrEdit($id = null)
    {
        if ($id) {
            $previous_exam_category = PreviousExamCategory::find($id);
            return view('backend.pages.previous-exams.category.create-or-edit', compact('previous_exam_category'));
        }
        return view('backend.pages.previous-exams.category.create-or-edit');
    }

    public function previousExamsCategoryStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('previous_exam_categories', 'name')
                        ->ignore($id)
                        ->where(function ($query) {
                            return $query->where('status', 1);
                        }),
                ],
            ]);

            $slug = $this->generateUniqueSlug($request->name, PreviousExamCategory::class);

            // Check if an inactive category with the same name exists
            $previous_exam_category = PreviousExamCategory::where('name', $request->name)->where('status', 0)->first();
            if ($previous_exam_category) {
                $previous_exam_category->status = 1;
                $previous_exam_category->save();
                $message = 'Previous Exam Category reactivated successfully';
            } else {
                $previous_exam_category = $id ? PreviousExamCategory::findOrFail($id) : new PreviousExamCategory();
                $previous_exam_category->name = $request->name;
                $previous_exam_category->slug = $slug;
                $previous_exam_category->status = 1;
                $previous_exam_category->save();
                $message = $id ? 'Previous Exam Category updated successfully' : 'Previous Exam Category created successfully';
            }

            return redirect()->route('previousExamsCategoryList')->with('success', $message);

        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function previousExamsCategoryDelete($id)
    {
        try {
            $previous_exam_category = PreviousExamCategory::find($id);
            $previous_exam_category->status = 0;
            $previous_exam_category->save();
            return redirect()->route('previousExamsCategoryList')->with('success', 'Previous Exam Category deleted successfully');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
