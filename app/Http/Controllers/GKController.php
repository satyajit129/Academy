<?php

namespace App\Http\Controllers;

use App\Models\GeneralKnowledge;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GKController extends Controller
{
    public function gkList()
    {
        // Step 1: Get all the records and group by date
        $general_knowledges = GeneralKnowledge::orderBy('date', 'desc')->get();
        $grouped_general_knowledges = $general_knowledges->groupBy('date');
        $grouped_pages = $grouped_general_knowledges->chunk(1);
        $page = request()->get('page', 1);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $grouped_pages->get($page - 1, collect([])),
            $grouped_general_knowledges->count(),
            1, // Number of groups per page
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
        return view('backend.pages.general_knowledge.list', compact('paginator'));
    }
    public function GKCreateorUpdate($id = null)
    {
        return view('backend.pages.general_knowledge.create_or_update');
    }
    public function gkStore(Request $request)
    {
        $validated_data = $request->validate([
            'date' => 'required|date',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'nullable|string|max:255',
            'questions.*.answer' => 'nullable|string',
        ]);

        $selected_date = Carbon::parse($validated_data['date'])->toDateString();
        $existing_questions_count = GeneralKnowledge::whereDate('date', $selected_date)->count();

        if ($existing_questions_count >= 10) {
            return redirect()->back()->withErrors(['error' => 'Only 10 questions are allowed per day.']);
        }

        foreach ($validated_data['questions'] as $question_data) {
            if (!empty($question_data['question']) || !empty($question_data['answer'])) {
                if ($existing_questions_count >= 10) {
                    break;
                }
                GeneralKnowledge::create([
                    'question' => $question_data['question'],
                    'answer' => $question_data['answer'],
                    'date' => $selected_date,
                ]);

                $existing_questions_count++;
            }
        }

        return redirect()->back()->with('success', 'General Knowledge saved successfully!');
    }
    public function GKEdit($date)
    {
        $general_knowledges = GeneralKnowledge::whereDate('date', $date)->get();
        return view('backend.pages.general_knowledge.edit', compact('general_knowledges', 'date'));
    }
    public function GKUpdate(Request $request, $date)
    {
        $validated_data = $request->validate([
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'nullable',
            'questions.*.answer' => 'nullable',
        ]);
        $selected_date = Carbon::parse($date)->toDateString();
        $general_knowledges = GeneralKnowledge::whereDate('date', $selected_date)->get();
        if ($general_knowledges->isEmpty()) {
            return redirect()->back()->withErrors(['error' => 'No questions found for the selected date.']);
        }
        foreach ($validated_data['questions'] as $index => $question_data) {
            if (isset($general_knowledges[$index])) {
                $general_knowledge = $general_knowledges[$index];
                if (!empty($question_data['question']) || !empty($question_data['answer'])) {
                    $general_knowledge->update([
                        'question' => $question_data['question'],
                        'answer' => $question_data['answer'],
                    ]);
                }
            }
        }
        return redirect()->route('GKList')->with('success', 'General Knowledge saved successfully!');
    }
}
