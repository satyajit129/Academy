@extends('backend.global.master')
@section('title', 'Members List')
@section('custom_css')
@endsection


@section('content')
<div class="container-fluid">
    @include('backend.global.get_greetings')
    <!-- row -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('backend.global.alert')
                <div class="card-header">
                    <h4 class="card-title">Member List</h4>
                    <a href="{{ route('teamMemberCreateorUpdate') }}" class="btn btn-primary btn-rounded">Add New Member</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Education</th>
                                    <th>Role</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($team_members as $team_member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset('images/'.$team_member->image) }}" alt="{{ $team_member->name }}" style="width: 100px; height:100px;">
                                        </td>
                                        <td>{{ $team_member->name }}</td>
                                        
                                        <td>{{ $team_member->education }}</td>
                                        <td>{{ $team_member->role }}</td>
                                        <td>
                                            <a href="{{ route('teamMemberCreateorUpdate', $team_member->id) }}" class="btn btn-danger btn-rounded">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('teamMemberDelete', $team_member->id) }}" class="btn btn-danger btn-rounded">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
@endsection