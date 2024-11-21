@extends('custom.global.app')

@section('custom_css')
<link rel="stylesheet" href="{{ asset('frontend/css/subject_wise_question_design.css') }}">
<style>
    .badge {
        display: inline-block;
        padding: 0.6em 0.6em;
    }
</style>
@endsection


@section('content')
    <div class="container-fluid page-header py-5" style="margin-bottom: 6rem;">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">জব সলিউশন</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white text-decoration-none" href="/">হোম পেজ </a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('jobSolution') }} ">সকল বিষয়</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div  style="background:#c9d6d9; padding: 2rem 0; margin-bottom: 6rem;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">{{ $subject->name ?? 'Subject Name' }}</h4>
                        </div>
                        <div class="card-body">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search Here...">
                        </div>
                        <div class="card-body">
                            <div id="searchResults"></div>
                            @if ($subject)
                                <div class="custom-tree" id="treeContainer">
                                    <ul class="custom-tree-list">
                                        <li class="custom-tree-item">
                                            <div class="underline_dots" style="display: flex; align-items: top; justify-content: space-between;">
                                                @php
                                                    $subject_id = encrypt($subject->id);
                                                @endphp
                                                <p class="custom-node subject_node">
                                                    <a href="{{ route('subjectWiseQuestions', ['subject_id' => $subject_id]) }}">
                                                        {{ $subject->name }} <span>({{ $subject->questions->count() }})</span>
                                                    </a>
                                                </p>
                                            </div>
                        
                                            @foreach ($subject->lessons as $lesson)
                                                @if ($lesson->questions->count() > 0)
                                                    <ul class="custom-tree-list">
                                                        <li class="custom-tree-item">
                                                            <div class="underline_dots" style="display: flex; align-items: top; justify-content: space-between;">
                                                                @php
                                                                    $lesson_id = encrypt($lesson->id);
                                                                @endphp
                                                                <p class="custom-node lesson_node">
                                                                    <a href="{{ route('lessonWiseQuestions', ['lesson_id' => $lesson_id, 'subject_id' => $subject_id]) }}">
                                                                        {{ $lesson->name }} <span>({{ $lesson->questions->count() }})</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            @foreach ($lesson->topics as $topic)
                                                                @if ($topic->questions->count() > 0)
                                                                    <ul class="custom-tree-list">
                                                                        <li class="custom-tree-item">
                                                                            <div class="underline_dots" style="display: flex; align-items: top; justify-content: space-between;">
                                                                                @php
                                                                                    $topic_id = encrypt($topic->id);
                                                                                @endphp
                                                                                <p class="custom-node topic_node">
                                                                                    <a href="{{ route('topicWiseQuestions', ['topic_id' => $topic_id, 'lesson_id' => $lesson_id, 'subject_id' => $subject_id]) }}">
                                                                                        {{ $topic->name }} <span>({{ $topic->questions->count() }})</span>
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                        
                                                                            @foreach ($topic->subTopics as $subtopic)
                                                                                @if ($subtopic->questions->count() > 0)
                                                                                    <ul class="custom-tree-list">
                                                                                        <li class="custom-tree-item">
                                                                                            <div class="underline_dots" style="display: flex; align-items: top; justify-content: space-between;">
                                                                                                @php
                                                                                                    $subtopic_id = encrypt($subtopic->id);
                                                                                                @endphp
                                                                                                <p class="custom-node subtopic_node">
                                                                                                    <a href="{{ route('subTopicWiseQuestions', ['sub_topic_id' => $subtopic_id, 'topic_id' => $topic_id, 'lesson_id' => $lesson_id, 'subject_id' => $subject_id]) }}">
                                                                                                        {{ $subtopic->name }} <span>({{ $subtopic->questions->count() }})</span>
                                                                                                    </a>
                                                                                                </p>
                                                                                            </div>
                                                                                        </li>
                                                                                    </ul>
                                                                                @endif
                                                                            @endforeach
                                                                        </li>
                                                                    </ul>
                                                                @endif
                                                            @endforeach
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <p>Subject not found.</p>
                            @endif
                        </div>
                        
                        
                        
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">অন্যান্য বিষয়াবলী </h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($subjects as $subject)
                                    @php
                                        $subject_id = encrypt($subject->id);
                                        $subject_slug = encrypt($subject->slug);
                                    @endphp
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="{{ route('jobSolutionSubjectWise', ['slug' => $subject_slug, 'id' => $subject_id]) }}" class="job-link d-flex justify-content-between w-100 text-decoration-none text-dark">
                                                <span>{{ $subject->name }}</span>
                                                <span class="badge bg-primary rounded-pill">{{ $subject->questions->count() }}</span>
                                            </a>
                                        </li>
                                @endforeach
                            </ul>
    
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    
@endsection


@section('custom_scripts')

<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            const query = $(this).val().toLowerCase();

            $('.custom-tree-item').each(function () {
                const itemText = $(this).text().toLowerCase();
                if (itemText.includes(query)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection
