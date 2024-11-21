    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="fa-solid fa-arrow-up"></i></a>
    <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('landing/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('landing/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('landing/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('landing/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/js/main.js') }}"></script>
    <!-- Toastr JS -->
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/cropper.js') }}"></script>

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
                width: 1000,
                height: 1000,
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
