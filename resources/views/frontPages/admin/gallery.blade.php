@extends('layouts.app')

@section('specifiedCss')
@endsection

@php
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
@endphp

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">তথ্য ও ছবি</b>
                    <button type="button" data-toggle="modal" data-target="#addGallery"
                            class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> তথ্য ও ছবি সংযোজন করুন
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>তথ্য</th>
                            <th>ছবি</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        @if(empty($page_info))
                            <h3 class="text-danger">No Pic</h3>
                        @else
                            <?php $number = 0; ?>
                            @foreach($page_info as $row)
                                <tr>
                                    <td>{{ str_replace(range(0,9),$bn_digits,++$number) }}</td>
                                    <td class="text-bold">{{ $row->name }}</td>
                                    <td>{{ $row->details }}</td>
                                    <td>
                                        <img style="height: 150px; width: 250px;" src="{{url('public/img/gallery/thumbs/'.$row->name)}}" alt="no_img">
                                    </td>

                                    <td>
                                        <a href="{{ url('admin/front/gallery/delete/'.$row->id) }}"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-----------------------------------------------
                 * gallery Add modal
                 *----------------------------------------------->
                <div class="modal fade" id="addGallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header padding">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-indent"></i> তথ্য ও ছবি সংযোজন</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/admin/front/store/gallery') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                        <label for="name">শাখা নাম</label>
                                        <input onchange="readURL(this)" type="file" id="pic" name="pic" required>
                                        <img id="picView" src="" style="width: 250px; height: 180px; display: none">
                                        <br><span style="color: red" id="img_err"></span>
                                        @include('errors.formValidateError',['inputName' => 'pic'])
                                    </div>
                                    <div class="form-group {{ $errors->has('details')?'has-error':'' }}">
                                        <label for="details">বিস্তারিত </label>
                                        <textarea name="details" id="details" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                    class="fa fa-database"></i> সংযোজন করুন
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- /end modal for store branch -->
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
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
    </script>
@endsection