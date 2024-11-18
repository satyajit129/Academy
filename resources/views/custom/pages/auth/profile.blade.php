@extends('custom.global.app')
@section('custom_css')
    <style>
        .cover-image img {
            max-height: 300px;
            object-fit: cover;
        }

        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid p-0">
        <!-- Cover Image -->
        <div class="cover-image position-relative">
            <img src="images/mountain.jpg" alt="Cover Image" class="img-fluid w-100">
            <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-3 shadow-sm">
                <i class="fas fa-edit"></i> Edit Cover
            </button>
        </div>

        <div class="container mt-4">
            <!-- Profile Section -->
            <div class="row align-items-center">
                <!-- Profile Photo -->
                <div class="col-md-3 text-center">
                    <img src="images/man.png" alt="User Photo" class="profile-photo rounded-circle img-thumbnail">
                    <button class="btn btn-primary btn-sm mt-3">
                        <i class="fas fa-edit"></i> Edit Photo
                    </button>
                </div>

                <!-- User Details -->
                <div class="col-md-9">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center bg-light">Profile Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->address }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $user->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>
                                    @if ($user->gender === 1)
                                        Male
                                    @elseif ($user->gender === 2)
                                        Female
                                    @else
                                        Others
                                    @endif
                                </td>
                            </tr>
                            
                            <tr>
                                <th>Nationality</th>
                                <td>{{ $user->nationality }}</td>
                            </tr>
                            <tr>
                                <th>Career Objective</th>
                                <td>{{ $user->career_objective }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button 
                        class="btn btn-primary btn-sm float-end edit_profile" 
                        data-user-id="{{ Auth::id() }}">
                        <i class="fas fa-edit"></i> Edit Profile
                    </button>

                </div>
            </div>

            <!-- Additional Details -->
            <div class="card mt-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Additional Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <!-- Education Section -->
                            <tr>
                                <th>Education</th>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($education as $item)
                                            <li style="list-style: none;">{{ $item['degree'] }}, {{ $item['year'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_addition_info" data-info-name="education">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                    
                            <!-- Experience Section -->
                            <tr>
                                <th>Experience</th>
                                <td>
                                    <ul class="mb-0">
                                        @foreach ($experience as $item)
                                            <li>{{ $item['position'] }}, {{ $item['company_name'] }} ({{ $item['start_date'] }} - {{ $item['end_date'] }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_addition_info" data-info-name="experience">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                    
                            <tr>
                                <th>Languages</th>
                                <td>
                                    @forelse ($languages as $item)
                                        {{ $item['language'] }} ({{ $item['proficiency'] }})<br>
                                    @empty
                                        <p>No languages added.</p>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_addition_info" data-info-name="language">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Social Links Section -->
                            <tr>
                                <th>Social Links</th>
                                <td>
                                    @forelse ($socialLinks as $item)
                                        <a href="{{ $item['link'] }}" target="_blank">{{ $item['platform'] }}</a><br>
                                    @empty
                                        <p>No social links added.</p>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-outline-primary edit_addition_info" data-info-name="social_links">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    
                </div>
            </div>
            <!-- Edit Profile Modal -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="profileEditModalBody">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Edit Profile Modal -->

            <!-- Edit Additional Info -->
            <div class="modal fade" id="editAdditionalInfoModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editAdditionalInfoModal">Edit Addition Field</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="editAdditionalInfoModalBody">
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Edit Profile Modal -->

        </div>

    </div>
@endsection

@section('custom_scripts')
    <script>
        function editSection(section) {
            alert('Edit ' + section + ' section');
            // Here, add the code to open a modal or form for editing the section.
        }
    </script>

<script>
    $(document).ready(function () {
        $('.edit_profile').on('click', function () {
            let userId = $(this).data('user-id');
            $.ajax({
                method: "GET",
                url: "{{ route('profileEdit') }}",
                data: {
                    userId: userId,
                },
                success: function (response) {
                    $('#profileEditModalBody').html(response);
                    $('#editProfileModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error("Error: " + status + " " + error);
                }
            });
            
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.edit_addition_info').on('click', function () { 
            let data = $(this).data('info-name')
            console.log(data);

            $.ajax({
                method: "GET",
                url: "{{ route('additionalInfoEdit') }}",
                data: {
                    data: data,
                },
                success: function (response) {
                    $('#editAdditionalInfoModalBody').html(response);
                    $('#editAdditionalInfoModal').modal('show');
                }, 
            })
        });
    });
</script>

@if ($errors->any())
<script>
    @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}', 'Validation Error', {
            positionClass: 'toast-top-right',
            closeButton: true,
            progressBar: true,
            timeOut: 5000, 
            extendedTimeOut: 1000, 
            preventDuplicates: true, 
            newestOnTop: true, 
            progressBar: true,
            closeHtml: '<button><i class="fa fa-times"></i></button>', 
        });
    @endforeach
</script>
@endif

@if(session('error'))
<script>
    toastr.error("{{ session('error') }}", "Error", {
        positionClass: 'toast-top-right',
        closeButton: true,
        progressBar: true,
        timeOut: 5000,
        extendedTimeOut: 1000,
        preventDuplicates: true,
        newestOnTop: true,
        progressBar: true,
        closeHtml: '<button><i class="fa fa-times"></i></button>',
    });
</script>
@endif
@if(session('success'))
<script>
    toastr.success("{{ session('success') }}", "Success", {
        positionClass: 'toast-top-right',
        closeButton: true,
        progressBar: true,
        timeOut: 5000,
        extendedTimeOut: 1000,
        preventDuplicates: true,
        newestOnTop: true,
        progressBar: true,
        closeHtml: '<button><i class="fa fa-times"></i></button>',
    });
</script>
@endif


@endsection
