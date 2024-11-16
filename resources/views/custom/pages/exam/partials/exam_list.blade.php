@forelse ($custom_exams as $custom_exam)
    @php
        $custom_exam_id = encrypt($custom_exam->id);
        $custom_exam_slug = encrypt($custom_exam->slug);
    @endphp
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 exam-item">
        <div class="card shadow-sm border-light rounded-0 position-relative custom-card">
            <span class="custom-badge">
                {{ $custom_exam->questions->count() }}
                <span class="visually-hidden">Total questions</span>
            </span>
            <div class="card-body">
                <h6 class="card-title text-success fw-bold exam-name mb-2">
                    {{ \Illuminate\Support\Str::limit($custom_exam->name, 50) }}
                </h6>
                <div class="d-flex justify-content-start gap-2 align-items-center mb-3">
                    <small class="text-muted">MCQ</small>
                </div>
                <div class="d-flex justify-content-start gap-1">
                    <a href="{{ route('customExamsquestions', ['id' => $custom_exam_id, 'slug' => $custom_exam_slug]) }}" class="btn btn-outline-success btn-sm rounded-0">
                        Test Now
                    </a>
                    <a href="" class="btn btn-outline-success btn-sm rounded-0">Result</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <!-- No data message -->
    <hr>
    <p class="text-center text-danger">কোন তথ্য পাওয়া যায়নি</p>
    <hr>
@endforelse

<!-- Pagination -->
<div class="p-2">
    {{ $custom_exams->links() }}
</div>



