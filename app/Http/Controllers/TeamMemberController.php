<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class TeamMemberController extends Controller
{
    use ImageUploadTrait;
    public function teamMembersList()
    {
        $team_members = TeamMember::where('status', 1)->latest()->get();
        return view('backend.pages.team.list', compact('team_members'));
    }
    public function teamMemberCreateorUpdate($id = null)
    {
        if ($id) {
            $members_info = TeamMember::find($id);
            return view('backend.pages.team.create_or_update', compact('members_info'));
        }
        return view('backend.pages.team.create_or_update');
    }
    public function teamMembersStore(Request $request, $id = null)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'education' => 'required',
                'role' => 'required',
                'image' => 'nullable|image',
                'facebook_link' => 'nullable',
                'insta_link' => 'nullable',
            ]);

            $members_info = TeamMember::where('email', $request->email)
                ->where('status', 0)
                ->first();

            if ($members_info) {
                $members_info->status = 1;
                $members_info->save();
                $message = 'Member reactivated successfully';
            } else {
                $members_info = $id ? TeamMember::findOrFail($id) : new TeamMember();
                $members_info->name = $request->name;
                $members_info->email = $request->email;
                $members_info->education = $request->education;
                $members_info->role = $request->role;
                $members_info->facebook_link = $request->facebook_link;
                $members_info->insta_link = $request->insta_link;
                $members_info->status = 1;

                if ($request->hasFile('image')) {
                    $imageName = $this->uploadImage($request->file('image'), 'images');
                    $members_info->image = $imageName;
                }

                $members_info->save();
                $message = $id ? 'Member updated successfully' : 'Member created successfully';
            }

            return redirect()->route('teamMembersList')->with('success', $message);

        } catch (Throwable $th) {
            Log::error('Error storing team member: ' . $th->getMessage(), [
                'exception' => $th
            ]);
            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }
    public function teamMemberDelete($id){
        try {
            $team_member = TeamMember::find($id);

            $team_member->status = 0;
            $team_member->save();
            return redirect()->route('teamMembersList')->with('success', 'Member deleted successfully');
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
