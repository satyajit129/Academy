@extends('custom.global.master')

@section('content')
    <div class="container-fluid ">
        <div class=" cover-image w-100 ">
            <img src="{{ asset('images/mountain.jpg') }}" class=" w-100" alt="">
        </div>
        <div class="profile-content mt-4 d-flex justify-content-between flex-lg-row flex-column">
            <div class="user-name">
                <h4>{{ $user->name }}</h4>
                <p>{{ $user->email }}</p>
            </div>
            <div class="user-image">
                @if ($user->image == null)
                    <img src="{{ asset('images/man.png') }}" alt="{{ $user->name }}" class="rounded-circle">
                @else
                    <img src="{{ asset('images/' . $user->image) }}" alt="" class="rounded-circle">
                @endif
            </div>
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
@endsection
