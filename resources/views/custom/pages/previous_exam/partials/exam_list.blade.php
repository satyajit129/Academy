
@forelse ($previous_job_exams as $previous_job_exam)
    @php
        $encryptedId = encrypt($previous_job_exam->id);
        $encryptedSlug = encrypt($previous_job_exam->slug);
    @endphp
    <div class="col-lg-4 col-md-6 col-12">
        <div style="border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden; box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); background-color: #ffffff; transition: transform 0.3s ease, box-shadow 0.3s ease; margin-bottom:10px;">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('images/card-image.png') }}" style="width: 130px; height:auto;margin-top:10px;">
            </div>
            <div style="padding: 20px; text-align: center;">
                <h6 style="font-size: 1.5rem; font-weight: bold; color: #333; margin-bottom: 15px;">{{ $previous_job_exam->name }}</h6>
                <div class="btn-section btn-single w-100">
                    <a href="{{ route('previousJobExamsQuestion', ['slug' => $encryptedSlug, 'id' => $encryptedId]) }}" style="width:100%; display: inline-block; text-decoration: none; color: #000000; background-color: #ffecec; padding: 10px 20px; border-radius: 5px; font-weight: bold; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2); transition: background-color 0.3s ease, transform 0.3s ease;">
                        <span>See List Questions</span> &nbsp;
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
        <hr>
            <p class="text-center text-danger"> কোন তথ্য পাওয়া যায়নি</p>
        <hr>
    @endforelse
