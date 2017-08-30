@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{ asset('/css/summernote/summernote.css') }}">
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage');
                @if($meeting->count() > 0)
                    @foreach($meeting as $notice)
                    <div class="card">
                        <div class="card-head">
                            <header>{{ $notice->title }}</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a class="btn btn-icon-toggle btn-modal"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                                    <a class="btn btn-icon-toggle btn-close"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                        </div><!--end .card-head -->
                        <div class="card-body">
                            <p>{{ $notice->notice }}</p>
                            @if($notice->notice_file)
                                <div class="">
                                    <a href="{{ asset('/notice/download/'.$notice->notice_file) }}" class="btn btn-success btn-xs link-reaction">DownLoad PDF</a>
                                </div>
                            @endif
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                    @endforeach
                @else
                    <div class="card alert alert-callout alert-danger">
                        <i class="fa fa-crosshairs"></i> এখনও কোনো নোটিশ দেওয়া হয়নি
                    </div>
                @endif
                <div class="card">
                    <div class="card-head-sm alert alert-callout alert-success">
                        সমিতির সভা নোটিশ তৈরি করুন :
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/front/meeting_notice/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('meetingTitle')? 'has-error':'' }}">
                                <input type="text" name="meetingTitle" id="meetingTitle" class="form-control">
                                <label for="meetingTitle">সভা টাইটেল </label>
                                @include('errors.formValidateError',['inputName' => 'meetingTitle'])
                            </div>
                            <div class="form-group {{ $errors->has('meetingContent')? 'has-error':'' }}">
                                <textarea name="meetingContent" id="meetingContent" class="form-control"></textarea>
                                <label for="meetingContent">সভা বিস্তারিত </label>
                                @include('errors.formValidateError',['inputName' => 'meetingContent'])
                            </div>
                            <div class="form-group {{ $errors->has('noticeFile')? 'has-error':'' }}">
                                <label for="noticeFile">সভা বিস্তারিত বিস্তারিত পিডিএফ ফাইল <span class="text-primary">( যদি থাকে )</span>  </label>
                                <input type="file" name="noticeFile" id="noticeFile" class="form-control"  accept=".pdf">
                                @include('errors.formValidateError',['inputName' => 'noticeFile'])
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> সংযোজন করুন </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{ asset('/js/libs/summerNote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection