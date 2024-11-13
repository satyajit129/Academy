<?php

namespace App\Http\Controllers;

use App\Models\PreviousExam;
use App\Models\PreviousExamCategory;
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
        $previous_job_exam = PreviousExam::with(['category','questions'])
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
    public function previousJobExamsStartExam($id){
        $decrypted_id = decrypt($id);
        $previous_job_exam = PreviousExam::with('questions.options', 'category')->find($decrypted_id);

        return view('custom.pages.previous_exam.start-exam', compact('previous_job_exam'));
    }

}
