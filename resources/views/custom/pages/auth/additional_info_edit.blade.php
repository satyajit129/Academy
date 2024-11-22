<form action="{{ route('additionalInfoUpdate', Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    @if($data == 'education')

    <!-- Education Section -->


    <div class="row">
        <div class="col-12">
            <label for="education" class="form-label">Education</label>
            <input type="hidden" name="type" value="education">
            <div id="education-fields">
                @if(isset($decodedData) && !empty($decodedData))
                    @foreach($decodedData as $item)
                        <div class="education-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                            <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="degree[]" value="{{ $item['degree'] ?? '' }}" placeholder="Degree Name" required>
                            <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="year[]" value="{{ $item['year'] ?? '' }}" placeholder="Year" required>
                            <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="grade_point[]" value="{{ $item['grade_point'] ?? '' }}" placeholder="Grade Point" required>
                        </div>
                    @endforeach
                @else
                    <!-- If no education data, show empty fields -->
                    <div class="education-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                        <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="degree[]" placeholder="Degree Name" required>
                        <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="year[]" placeholder="Year" required>
                        <input type="text" class="form-control mb-2 mb-sm-0 flex-fill" name="grade_point[]" placeholder="Grade Point" required>
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                <button type="button" class="btn btn-primary" id="add-education">Add Education</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // Add new education item
            $('#add-education').on('click', function() {
                let newEducationItem = `
                <div class="education-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                    <input type="text" class="form-control flex-fill" name="degree[]" placeholder="Degree Name" required>
                    <input type="text" class="form-control flex-fill" name="year[]" placeholder="Year" required>
                    <input type="text" class="form-control flex-fill" name="grade_point[]" placeholder="Grade Point" required>
                    <button type="button" class="btn btn-danger remove-education"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `;
                $('#education-fields').append(newEducationItem);
            });

            // Remove education item
            $(document).on('click', '.remove-education', function() {
                $(this).closest('.education-item').remove();
            });

            // Form submission validation
            $('#form').on('submit', function(e) {
                let isValid = true;
                $('.education-item').each(function() {
                    let degree = $(this).find('input[name="degree[]"]').val().trim();
                    let year = $(this).find('input[name="year[]"]').val().trim();
                    let grade_point = $(this).find('input[name="grade_point[]"]').val().trim();

                    // Check if the fields are empty
                    if (!degree || !year || !grade_point) {
                        isValid = false;
                        alert('Please fill all the fields for each education item.');
                        return false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

    </script>

    @elseif($data == 'experience')

    <!-- Experience Section -->
    <div class="row">
        <div class="col-md-12">
            <label for="experience" class="form-label">Experience</label>
            <input type="hidden" name="type" value="experience">
            <div id="experience-fields">
                @if(isset($decodedData) && !empty($decodedData))
                    @foreach($decodedData as $item)
                        <div class="experience-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                            <input type="text" class="form-control flex-fill" name="company_name[]" value="{{ $item['company_name'] ?? '' }}" placeholder="Company Name" required>
                            <input type="text" class="form-control flex-fill" name="position[]" value="{{ $item['position'] ?? '' }}" placeholder="Position" required>
                            <input type="date" class="form-control flex-fill" name="start_date[]" value="{{ $item['start_date'] ?? '' }}" placeholder="Start Date" required>
                            <input type="date" class="form-control flex-fill" name="end_date[]" value="{{ $item['end_date'] ?? '' }}" placeholder="End Date" required>
                        </div>
                    @endforeach
                @else
                    <!-- If no experience data, show empty fields -->
                    <div class="experience-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                        <input type="text" class="form-control flex-fill" name="company_name[]" placeholder="Company Name" required>
                        <input type="text" class="form-control flex-fill" name="position[]" placeholder="Position" required>
                        <input type="date" class="form-control flex-fill" name="start_date[]" placeholder="Start Date" required>
                        <input type="date" class="form-control flex-fill" name="end_date[]" placeholder="End Date" required>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" id="add-experience">Add Experience</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            // Add new experience item
            $('#add-experience').on('click', function() {
                let newExperienceItem = `
                <div class="experience-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                    <input type="text" class="form-control flex-fill" name="company_name[]" placeholder="Company Name" required>
                    <input type="text" class="form-control flex-fill" name="position[]" placeholder="Position" required>
                    <input type="date" class="form-control flex-fill" name="start_date[]" placeholder="Start Date" required>
                    <input type="date" class="form-control flex-fill" name="end_date[]" placeholder="End Date" required>
                    <button type="button" class="btn btn-danger remove-experience"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `;
                $('#experience-fields').append(newExperienceItem);
            });

            // Remove experience item
            $(document).on('click', '.remove-experience', function() {
                $(this).closest('.experience-item').remove();
            });

            // Form submission validation
            $('#form').on('submit', function(e) {
                let isValid = true;
                $('.experience-item').each(function() {
                    let company_name = $(this).find('input[name="company_name[]"]').val().trim();
                    let position = $(this).find('input[name="position[]"]').val().trim();
                    let start_date = $(this).find('input[name="start_date[]"]').val().trim();
                    let end_date = $(this).find('input[name="end_date[]"]').val().trim();

                    // Check if the fields are empty
                    if (!company_name || !position || !start_date || !end_date) {
                        isValid = false;
                        alert('Please fill all the fields for each experience item.');
                        return false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

    </script>

    @elseif($data == 'language')

    <div class="row">
        <div class="col-md-12">
            <label for="language" class="form-label">Languages</label>
            <input type="hidden" name="type" value="language">
            <div id="language-fields">
                @if(isset($decodedData) && !empty($decodedData))
                    @foreach($decodedData as $item)
                        <div class="language-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                            <input type="text" class="form-control flex-fill" name="language[]" value="{{ $item['language'] ?? '' }}" placeholder="Language" required>
                            <input type="text" class="form-control flex-fill" name="proficiency[]" value="{{ $item['proficiency'] ?? '' }}" placeholder="Proficiency" required>
                        </div>
                    @endforeach
                @else
                    <!-- Default empty language field -->
                    <div class="language-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                        <input type="text" class="form-control flex-fill" name="language[]" placeholder="Language" required>
                        <input type="text" class="form-control flex-fill" name="proficiency[]" placeholder="Proficiency" required>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" id="add-language">Add Language</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            // Add new language item
            $('#add-language').on('click', function() {
                let newLanguageItem = `
                <div class="language-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                    <input type="text" class="form-control flex-fill" name="language[]" placeholder="Language" required>
                    <input type="text" class="form-control flex-fill" name="proficiency[]" placeholder="Proficiency" required>
                    <button type="button" class="btn btn-danger remove-language"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `;
                $('#language-fields').append(newLanguageItem);
            });

            // Remove language item
            $(document).on('click', '.remove-language', function() {
                $(this).closest('.language-item').remove();
            });

            // Form submission validation
            $('#form').on('submit', function(e) {
                let isValid = true;
                $('.language-item').each(function() {
                    let language = $(this).find('input[name="language[]"]').val().trim();
                    let proficiency = $(this).find('input[name="proficiency[]"]').val().trim();

                    // Check if the fields are empty
                    if (!language || !proficiency) {
                        isValid = false;
                        alert('Please fill all the fields for each language item.');
                        return false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

    </script>

    @elseif($data == 'social_links')

    <div class="row">
        <div class="col-md-12">
            <label for="social_links" class="form-label">Social Links</label>
            <input type="hidden" name="type" value="social_links">
            <div id="social-links-fields">
                @if(isset($decodedData) && !empty($decodedData))
                    @foreach($decodedData as $item)
                        <div class="social-links-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                            <input type="text" class="form-control flex-fill" name="platform[]" value="{{ $item['platform'] ?? '' }}" placeholder="Platform" required>
                            <input type="text" class="form-control flex-fill" name="link[]" value="{{ $item['link'] ?? '' }}" placeholder="Link" required>
                        </div>
                    @endforeach
                @else
                    <!-- Default empty social link field -->
                    <div class="social-links-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                        <input type="text" class="form-control flex-fill" name="platform[]" placeholder="Platform" required>
                        <input type="text" class="form-control flex-fill" name="link[]" placeholder="Link" required>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" id="add-social-link">Add Social Link</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </>
    </div>
    

    <script>
        $(document).ready(function() {
            // Add new social link item
            $('#add-social-link').on('click', function() {
                let newSocialLinkItem = `
                <div class="social-links-item mb-3 d-flex flex-column flex-sm-row gap-2 align-items-start align-items-sm-center">
                    <input type="text" class="form-control flex-fill" name="platform[]" placeholder="Platform" required>
                    <input type="text" class="form-control flex-fill" name="link[]" placeholder="Link" required>
                    <button type="button" class="btn btn-danger remove-social-link"><i class="fa-solid fa-xmark"></i></button>
                </div>
            `;
                $('#social-links-fields').append(newSocialLinkItem);
            });

            // Remove social link item
            $(document).on('click', '.remove-social-link', function() {
                $(this).closest('.social-links-item').remove();
            });

            // Form submission validation
            $('#form').on('submit', function(e) {
                let isValid = true;
                $('.social-links-item').each(function() {
                    let platform = $(this).find('input[name="platform[]"]').val().trim();
                    let link = $(this).find('input[name="link[]"]').val().trim();

                    // Check if the fields are empty
                    if (!platform || !link) {
                        isValid = false;
                        alert('Please fill all the fields for each social link item.');
                        return false;
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

    </script>
    @endif
</form>
