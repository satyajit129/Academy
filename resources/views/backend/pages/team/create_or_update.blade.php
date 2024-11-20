@extends('backend.global.master')
@section('title', 'Member Create/Edit')
@section('custom_css')
@endsection


@section('content')
    <div class="container-fluid">
        @include('backend.global.get_greetings')
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    @include('backend.global.alert')
                    <div class="card-header">
                        <h4 class="card-title">Member Information</h4>
                        <a href="{{ route('teamMembersList') }}" class="btn btn-primary btn-rounded">Back To List</a>
                    </div>
                    <form action="{{ route('teamMembersStore', isset($members_info) ? $members_info->id : '') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">
                            <div class="basic-form">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" 
                                        value="{{ old('name', isset($members_info) ? $members_info->name : '') }}"
                                        placeholder="Enter name" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" 
                                        value="{{ old('email', isset($members_info) ? $members_info->email : '') }}"
                                        placeholder="Enter Email" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="education">Last Education</label>
                                    <input type="text" class="form-control" name="education" 
                                        value="{{ old('education', isset($members_info) ? $members_info->education : '') }}"
                                        placeholder="Enter Last Education Info" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <input type="text" class="form-control" name="role" 
                                        value="{{ old('role', isset($members_info) ? $members_info->role : '') }}"
                                        placeholder="Enter Role" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook_link" 
                                        value="{{ old('facebook_link', isset($members_info) ? $members_info->facebook_link : '') }}"
                                        placeholder="Enter facebook_link" required>
                                </div>
                                <div class="form-group">
                                    <label for="insta_link">Insta_link</label>
                                    <input type="text" class="form-control" name="insta_link" 
                                        value="{{ old('insta_link', isset($members_info) ? $members_info->insta_link : '') }}"
                                        placeholder="Enter insta_link" required>
                                </div>
                        
                                <!-- Image Input Field: Should be type 'file' for image upload -->
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <!-- Display image preview if available -->
                                    @if (isset($members_info) && $members_info->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('images/' . $members_info->image) }}" 
                                                 alt="Image Preview" style="max-width: 150px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="rounded-button">
                                <button type="submit" class="btn btn-rounded btn-outline-primary pl-4 pr-4">Submit</button>
                            </div>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('custom_scripts')

@endsection
