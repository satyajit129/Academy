<form action="{{ route('profileUpdate',$user_info->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name"
                value="@if (isset($user_info) && $user_info->name){{ $user_info->name }}@endif">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control"
                value="@if (isset($user_info) && $user_info->email) {{ $user_info->email }}@endif" readonly>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone"
                value="@if (isset($user_info) && $user_info->phone){{ $user_info->phone }}@endif">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address"
                value="@if (isset($user_info) && $user_info->address){{ $user_info->address }}@endif">
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="date_of_birth"
                value="@if (isset($user_info) && $user_info->date_of_birth){{ $user_info->date_of_birth }}@endif">
        </div>
        
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender">
                <option selected disabled> Select One</option>
                <option value="1" @if (isset($user_info) && $user_info->gender == 1) selected @endif>Male</option>
                <option value="2" @if (isset($user_info) && $user_info->gender == 2) selected @endif>Female</option>
                <option value="3" @if (isset($user_info) && $user_info->gender == 3) selected @endif>Other</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="nationality" class="form-label">Nationality</label>
            <input type="text" class="form-control" name="nationality"
                value="@if (isset($user_info) && $user_info->nationality){{ $user_info->nationality }}@endif">
        </div>
        <div class="mb-3">
            <label for="careerObjective" class="form-label">Career Objective</label>
            <textarea class="form-control" rows="3"
                name="career_objective">@if (isset($user_info) && $user_info->career_objective){{ $user_info->career_objective }}@endif</textarea>
        </div>
    </div>
 
    <div class="modal-footer" style="padding: 0.75rem 0;">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>