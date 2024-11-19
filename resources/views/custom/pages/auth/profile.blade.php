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
                    <form action="{{ route('updateProfileImage') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <img src="" style="width: 200px;display: none;" class="show-image rounded-circle" > 
                        <input type="file" name="image" class="image">
                       
                        <input type="hidden" name="image_base64">
    
                        <button class="btn btn-success w-100 mt-2">Submit</button>
    
                    </form>
    
    
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
                            <tr>
                                <th>Education</th>
                                <td>
                                    @if (!empty($education) && is_iterable($education))
                                        <ul>
                                            @foreach ($education as $index => $item)
                                                <li>
                                                    Degree: {{ $item['degree'] }}, Year: {{ $item['year'] }}, Grade: {{ $item['grade_point'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No Education Info Added
                                    @endif
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
                                    @if (!empty($experience) && is_iterable($experience))
                                        <ul>
                                            @foreach ($experience as $item)
                                                <li>
                                                    Position:{{ $item['position'] }}, Institute:{{ $item['company_name'] }},  From:{{ $item['start_date'] }} - To:{{ $item['end_date'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        No Experience Info Added
                                    @endif
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
                                    @if (!empty($languages) && is_iterable($languages))
                                        <ul>
                                            @foreach ($languages as $item)
                                                <li>
                                                    {{ $item['language'] }} ({{ $item['proficiency'] }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No languages added.</p>
                                    @endif
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
                                    @if (!empty($socialLinks) && is_iterable($socialLinks))
                                        <ul>
                                            @foreach ($socialLinks as $item)
                                                <li>
                                                    <a href="{{ $item['link'] }}" target="_blank">{{ $item['platform'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>No social links added.</p>
                                    @endif
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

            {{-- cropper modal --}}
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">

                <div class="modal-dialog modal-xl" role="document">
        
                    <div class="modal-content">
        
                        <div class="modal-header">
        
                            <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload Example - ItSolutionStuff.com</h5>
        
                            <button type="button" class="close" data-bs-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                            
        
                        </div>
        
                        <div class="modal-body">
        
                            <div class="img-container">
        
                                <div class="row">
        
                                    <div class="col-md-12">
        
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
        
                                    </div>
        
                                        <div class="preview"></div>
        
                                </div>
        
                            </div>
        
                        </div>
        
                        <div class="modal-footer">
        
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>
            {{-- cropper modal --}}

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
<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    /*------------------------------------------
    Image Change Event
    --------------------------------------------*/
    $("body").on("change", ".image", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };

        var reader;
        var file;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    /*------------------------------------------
    Show Model Event
    --------------------------------------------*/
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;

        // Clear the image file and preview
        image.src = '';
        $(".image").val(''); // Reset the file input
    });

    /*------------------------------------------
    Crop Button Click Event
    --------------------------------------------*/
    $("#crop").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 100,
            height: 100,
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result; 
                $("input[name='image_base64']").val(base64data);
                $(".show-image").show();
                $(".show-image").attr("src", base64data);
                $("#modal").modal('toggle');
            };
        });
    });
</script>


@endsection
