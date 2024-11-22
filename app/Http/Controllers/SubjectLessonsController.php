<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectLessonsController extends Controller
{
    use Slugger;
    public function subjectLessonsList()
    {
        $subject_lessons = SubjectLesson::with('subject')
            ->whereHas('subject', function ($query) {
                $query->where('status', 1);
            })
            ->get();

        return view('backend.pages.subject-lessons.list', compact('subject_lessons'));
    }
    public function subjectLessonsCreateOrEdit($id = null)
    {

        $subjects = Subject::where('status', 1)->get();
        if ($id) {

            $subject_lesson = SubjectLesson::with('subject')->find($id);
            return view('backend.pages.subject-lessons.create-or-edit', compact('subject_lesson', 'subjects'));
        }
        return view('backend.pages.subject-lessons.create-or-edit', compact('subjects'));
    }

    public function subjectLessonsStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('subject_lessons')->where(function ($query) {
                        return $query->where('status', 1);
                    })->ignore($id),
                ],
                'subject_id' => 'required',
            ]);
            $subject_lesson = SubjectLesson::where('subject_id', $request->subject_id)
                ->where('name', $request->name)
                ->where('status', 0)
                ->first();

            if ($subject_lesson) {
                $subject_lesson->status = 1;
                $subject_lesson->save();
                $message = 'Subject Lesson reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, SubjectLesson::class);
                $subject_lesson = $id ? SubjectLesson::findOrFail($id) : new SubjectLesson();
                $subject_lesson->name = $request->name;
                $subject_lesson->slug = $slug;
                $subject_lesson->subject_id = $request->subject_id;
                $subject_lesson->status = 1;
                $subject_lesson->save();
                $message = $id ? 'Subject Lesson updated successfully' : 'Subject Lesson created successfully';
            }
            return redirect()->route('subjectLessonsList')->with('success', $message);
        } catch (\Exception $exception) {
            return redirect()->route('subjectLessonsList')->with('error', $exception->getMessage());
        }
    }

    public function subjectLessonsDelete($id)
    {
        try {
            $subject_lesson = SubjectLesson::find($id);
            $subject_lesson->status = 0;
            $subject_lesson->save();
            return redirect()->route('subjectLessonsList')->with('success', 'Subject Lesson deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->route('subjectLessonsList')->with('error', $exception->getMessage());
        }
    }
}
