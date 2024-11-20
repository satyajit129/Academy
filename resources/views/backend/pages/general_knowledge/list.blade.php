@extends('backend.global.master')
@section('title', 'General Knowledge List')
@section('custom_css')
@endsection


@section('content')
<div class="container-fluid">
    @include('backend.global.get_greetings')
    <!-- row -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                @include('backend.global.alert')
                <div class="card-header">
                    <h4 class="card-title">General Knowledge List</h4>
                    <a href="{{ route('GKCreateorUpdate') }}" class="btn btn-primary btn-rounded">Add New Question</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered verticle-middle table-responsive-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Date</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
@endsection