<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectLesson;
use App\Models\SubjectTopic;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class SubjectTopicsController extends Controller
{
    use Slugger;
    public function subjectTopicsList(){
        $subject_topics = SubjectTopic::with('subject', 'subjectLessons')->where('status', 1)->get();
        return view('backend.pages.subject-topics.list', compact('subject_topics'));
    }

    public function subjectTopicsCreateOrEdit($id = null){
        $subjects = Subject::where('status', 1)->get();
        $subject_lessons = SubjectLesson::where('status', 1)->get();
        if($id){
            $subject_topic = SubjectTopic::with('subject', 'subjectLessons')->find($id);
            return view('backend.pages.subject-topics.create-or-edit', compact('subject_topic', 'subjects', 'subject_lessons'));
        }
        return view('backend.pages.subject-topics.create-or-edit', compact('subjects', 'subject_lessons'));
    }
    public function getSubjectLessons(Request $request){
        $id = $request->subject_id;
        $subject_lessons = SubjectLesson::where('subject_id', $id)->get();
        return response()->json($subject_lessons);
    }
    public function subjectTopicsStore(Request $request, $id = null){
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('subject_topics')->where(function ($query) {
                        return $query->where('status', 1);
                    })->ignore($id),
                ],
                'subject_id' => 'required',
                'lesson_id' => 'required',
            ]);
            $subject_topic = SubjectTopic::where('subject_id', $request->subject_id)
                ->where('lesson_id', $request->lesson_id)
                ->where('name', $request->name)
                ->where('status', 0)
                ->first();

            if ($subject_topic) {
                $subject_topic->status = 1;
                $subject_topic->save();
                $message = 'Subject Topic reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, SubjectTopic::class);
                $subject_topic = $id ? SubjectTopic::findOrFail($id) : new SubjectTopic();
                $subject_topic->name = $request->name;
                $subject_topic->slug = $slug;
                $subject_topic->subject_id = $request->subject_id;
                $subject_topic->lesson_id = $request->lesson_id;
                $subject_topic->status = 1;
                $subject_topic->save();
                $message = $id ? 'Subject Topic updated successfully' : 'Subject Topic created successfully';
            }
            return redirect()->route('subjectTopicsList')->with('success', $message);
        }
        catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
        
    }
    public function subjectTopicsDelete($id){
        try {
            $subject_topic = SubjectTopic::find($id);
            $subject_topic->status = 0;
            $subject_topic->save();
            return redirect()->route('subjectTopicsList')->with('success', 'Subject Topic deleted successfully');
        } catch (\Exception $exception) {
            return redirect()->route('subjectTopicsList')->with('error', $exception->getMessage());
        }
    }
}
