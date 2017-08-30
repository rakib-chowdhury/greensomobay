@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{ url('public/') }}/css/summernote/summernote.css">
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                @if(empty($page_info) || $page_info == null)
                    <div class="card alert alert-callout alert-success">
                        {{$page_title}} :
                    </div>
                    <form action="{{ url('admin/front/'.$type.'/store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{$type}}">
                        <div class="form-group {{ $errors->has('about_us')? 'has-error':'' }}">
                            <textarea name="about_us" class="form-control textEditor"></textarea>
                            @include('errors.formValidateError',['inputName' => 'about_us'])
                        </div>
                        <div class="form-group {{ $errors->has('pic')? 'has-error':'' }}">
                            <input onchange="readURL(this)" type="file" id="pic" name="pic" required
                                   class="">
                            <img id="picView" src="" >
                            <br><span style="color: red" id="img_err"></span>
                            @include('errors.formValidateError',['inputName' => 'pic'])
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> সংযোজন করুন </button>
                        </div>
                    </form>
                @else
                    <div class="card alert alert-callout alert-success">
                        {{$page_title}} :
                    </div>
                    <form action="{{ url('admin/front/'.$type.'/update') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="hidden" name="update_id" value="{{$page_info->id}}">
                        <div class="form-group {{ $errors->has('about_us')? 'has-error':'' }}">
                            <textarea name="about_us" class="form-control textEditor">{{ $page_info->content }}</textarea>
                            @include('errors.formValidateError',['inputName' => 'about_us'])
                        </div>
                        <div class="form-group {{ $errors->has('pic')? 'has-error':'' }}">
                            <input onchange="readURL(this)" type="file" id="pic" name="pic">
                            <img id="picView" src="{{url('public/img/frontend/'.$page_info->pic)}}" style="width: 250px; height: 180px;">
                            <br><span style="color: red" id="img_err"></span>
                            @include('errors.formValidateError',['inputName' => 'pic'])
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> সংশোধন করুন </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{ url('public') }}/js/libs/summerNote/summernote.min.js"></script>
    <script>
        var img_extn = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];
        function readURL(input) {
            console.log('dfs');
            if (input.files && input.files[0]) {
                var i_name = input.files[0]['name'].split('.');
                var img = false;
                $.each(img_extn, function (i, v) {
                    //console .log(v);
                    if (i_name[i_name.length - 1] == v) {
                        img = true;
                    }
                });
                if(input.files[0]['size']>1048576){///1mb=1048576 bytes
                    img=false;
                }
                if (img == false) {
                    var x = document.getElementById('img_err');
                    x.style.color = 'red';
                    x.innerText = 'ছবি অবশ্যই "jpg/png" ফরমেট এ হতে হবে এবং ১ মেগাবাইট আর চেয়ে কম হতে হবে';
                    document.getElementById('pic').value = '';

                    var x = document.getElementById('picView');
                    x.style.display = 'none';

                } else {
                    var x = document.getElementById('img_err');
                    x.style.color = 'red';
                    x.innerText = '';
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#picView')
                                .attr('src', e.target.result)
                                .width(250)
                                .height(180);
                    };
                    var x = document.getElementById('picView');
                    x.style.display = 'block';

                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

        $(document).ready(function () {
            $('.textEditor').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true
            });
        });

    </script>
@endsection