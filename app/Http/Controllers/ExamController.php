<?php

namespace App\Http\Controllers;

use App\Models\CustomExam;
use Illuminate\Http\Request;

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
    public function customExamsquestions($id, $slug){
        $decrypted_id = decrypt($id);
        $decrypted_slug = decrypt($slug);
        // Load the exam with paginated questions
        $custom_exam_questions = CustomExam::with('questions.options')
            ->where('slug', $decrypted_slug)
            ->where('id', $decrypted_id)
            ->first();

        return view('custom.pages.exam.exam_question_lists', compact('custom_exam_questions'));
    }

}
