
@forelse ($previous_job_exams as $previous_job_exam)
    @php
        $encryptedId = encrypt($previous_job_exam->id);
        $encryptedSlug = encrypt($previous_job_exam->slug);
    @endphp
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 exam-item">
        <div class="card shadow-sm border-light rounded-0">
            <div class="card-body">
                <h5 class="card-title text-success fw-bold exam-name mb-2">
                    {{ \Illuminate\Support\Str::limit($previous_job_exam->name, 50) }}
                    <span class="badge bg-success">{{ $previous_job_exam->questions->count() }}</span>
                </h5>
                <div class="d-flex justify-content-start gap-2 align-items-center mb-3">
                    <small class="text-muted">
                        {{ Carbon\Carbon::parse($previous_job_exam->exam_date)->format('j F Y') }}
                    </small> |
                    <small class="text-muted ">MCQ</small> |
                    <small class="text-muted">{{ $previous_job_exam->category->name }}</small>
                </div>
                <div class="d-flex justify-content-between">
                    
                    <a href="{{ route('previousJobExamsQuestion', ['slug' => $encryptedSlug, 'id' => $encryptedId]) }}"
                       class="btn btn-outline-success btn-sm rounded-0">
                        See all Questions
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

<div class="p-2">
    {{ $previous_job_exams->links() }}
</div>
