<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class SubjectController extends Controller
{
    use Slugger;
    public function subjectList()
    {
        $subjects = Subject::where('status', true)->get();
        return view('backend.pages.subjects.list', compact('subjects'));
    }


    public function subjectCreateOrEdit($id = null)
    {
        if ($id) {
            $subject = Subject::find($id);
            return view('backend.pages.subjects.create-edit', compact('subject'));
        }
        return view('backend.pages.subjects.create-edit');
    }


    public function subjectStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('subjects')->where(function ($query) {
                        return $query->where('status', 1);
                    })->ignore($id),
                ],
            ]);

            $subject = Subject::where('name', $request->name)
                ->where('status', 0)
                ->first();

            if ($subject) {
                $subject->status = 1;
                $subject->save();
                $message = 'Subject reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, Subject::class);
                $subject = $id ? Subject::findOrFail($id) : new Subject();
                $subject->name = $request->name;
                $subject->slug = $slug;
                $subject->status = 1;
                $subject->save();
                $message = $id ? 'Subject updated successfully' : 'Subject created successfully';
            }
            return redirect()->route('subjectList')->with('success', $message);
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function subjectDelete($id)
    {
        try {
            $subject = Subject::find($id);

            $subject->status = 0;
            $subject->save();
            return redirect()->route('subjectList')->with('success', 'Subject deleted successfully');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }



}
