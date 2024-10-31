<?php

namespace App\Http\Controllers;

use App\Models\PreviousExam;
use App\Models\Year;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class PreviousExamsController extends Controller
{
    use Slugger;
    public function previousExamsList(){
        $previous_exams = PreviousExam::where('status', 1)->latest()->get();
        return view('backend.pages.previous-exams.list', compact('previous_exams'));
    }

    public function previousExamsCreateOrEdit($id = null){
        $years = Year::where('status', 1)->get();
        if ($id) {
            $previous_exam = PreviousExam::find($id);
            return view('backend.pages.previous-exams.create-edit', compact('previous_exam', 'years'));
        }
        return view('backend.pages.previous-exams.create-edit', compact('years'));
    }

    public function previousExamsStore(Request $request, $id = null){
        try{
            $request->validate([
                'name' => 'required',
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
            if($previous_exam){
                $previous_exam->status = 1;
                $previous_exam->save();
                $message = 'Previous Exam reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, PreviousExam::class);
                $previous_exam = $id ? PreviousExam::findOrFail($id) : new PreviousExam();
                $previous_exam->name = $request->name;
                $previous_exam->slug = $slug;
                $previous_exam->exam_code = $request->exam_code;
                $previous_exam->year_id = $request->year_id;
                $previous_exam->exam_date = $request->exam_date;
                $previous_exam->exam_type = $request->exam_type;
                $previous_exam->duration = $total_duration;
                $previous_exam->status = 1;
                $previous_exam->save();
                $message = 'Previous Exam added successfully';
            }
            return redirect()->route('previousExamsList')->with('success', $message);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function previousExamsDelete($id){
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

}
