<?php

namespace App\Http\Controllers;

use App\Models\SubjectSubTopic;
use App\Models\SubjectTopic;
use App\Traits\Slugger;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class SubjectSubTopicsController extends Controller
{
    use Slugger;
    public function subjectSubTopicsList()
    {
        $subject_sub_topics = SubjectSubTopic::with('subjectTopic', 'subject')->where('status', 1)->get();
        // dd($subject_sub_topics);
        return view('backend.pages.subject-sub-topics.list', compact('subject_sub_topics'));
    }

    public function subjectSubTopicsCreateOrEdit($id = null)
    {
        $subject_topics = SubjectTopic::where('status', 1)->get();
        if ($id) {
            $subject_sub_topic = SubjectSubTopic::find($id);
            return view('backend.pages.subject-sub-topics.create-or-edit', compact('subject_sub_topic', 'subject_topics'));
        }
        return view('backend.pages.subject-sub-topics.create-or-edit', compact('subject_topics'));
    }
    public function subjectSubTopicsStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('subject_sub_topics')->where(function ($query) {
                        return $query->where('status', 1);
                    })->ignore($id),
                ],
                'topic_id' => 'required',
            ]);

            $subject_sub_topic = SubjectSubTopic::where('topic_id', $request->topic_id)
                ->where('name', $request->name)
                ->where('status', 0)
                ->first();

            if ($subject_sub_topic) {
                $subject_sub_topic->status = 1;
                $subject_sub_topic->save();
                $message = 'Subject Sub Topic reactivated successfully';
            } else {
                $slug = $this->generateUniqueSlug($request->name, SubjectSubTopic::class);
                $subject_sub_topic = $id ? SubjectSubTopic::findOrFail($id) : new SubjectSubTopic();
                $subject_sub_topic->name = $request->name;
                $subject_sub_topic->slug = $slug;
                $subject_sub_topic->topic_id = $request->topic_id;
                $subject_sub_topic->status = 1;
                $subject_sub_topic->save();
                $message = $id ? 'Subject Sub Topic updated successfully' : 'Subject Sub Topic created successfully';
            }
            return redirect()->route('subjectSubTopicsList')->with('success', $message);
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function subjectSubTopicsDelete($id)
    {
        $subject_sub_topic = SubjectSubTopic::find($id);
        $subject_sub_topic->status = 0;
        $subject_sub_topic->save();
        return redirect()->route('subjectSubTopicsList')->with('success', 'Subject Sub Topic deleted successfully');
    }
}
