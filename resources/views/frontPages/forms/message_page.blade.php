@extends('layouts.public')

@section('customCss')
    <style>
        .input-group .form-control-select {
            margin-bottom: -6px
        }
    </style>
@endsection

@section('content')
    <div class="content_info content_area_main">
        <div class="container">
            <div class="paddings-mini">
                @include('includes.flashMessage')
            </div>
        </div>
    </div>
@endsection

@section('customJs')

@endsection