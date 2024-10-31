<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class YearsController extends Controller
{
    public function yearsList(){
        $years = Year::where('status', 1)->latest()->get();
        return view('backend.pages.years.years-list', compact('years'));
    }
    public function yearsCreateOrEdit($id = null){
        if ($id) {
            $year = Year::find($id);
            return view('backend.pages.years.create-edit', compact('year'));
        }
        return view('backend.pages.years.create-edit');
    }

    public function yearsStore(Request $request, $id = null){
        try {
            $request->validate([
                'year' => [
                    'required',
                    Rule::unique('years')->where(function ($query) {
                        return $query->where('status', 1);
                    })->ignore($id),
                ],
            ]);
            $year = Year::where('year', $request->year)
                ->where('status', 0)
                ->first();
            if ($year) {
                $year->status = 1;
                $year->save();
                $message = 'Year reactivated successfully';
            } else {
                $year = $id ? Year::findOrFail($id) : new Year();
                $year->year = $request->year;
                $year->status = 1;
                $year->save();
                $message = $id ? 'Year updated successfully' : 'Year created successfully';
            }
            return redirect()->route('yearsList')->with('success', $message);
        } catch  (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function yearsDelete($id){
        try {
            $year = Year::find($id);
            $year->status = 0;
            $year->save();
            return redirect()->route('yearsList')->with('success', 'Year deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->route('yearsList')->with('error', $exception->getMessage());
        }
    }
}
