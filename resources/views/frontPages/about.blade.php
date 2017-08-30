@extends('layouts.public')

@section('content')

        <!-- Info Content - Boxes Services-->
<div class="content_info">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            @if(sizeof($page_info)==0)
                <img style="width: 100%; height: 250px;" src="{{url('public/img/frontend/no_img.jpg')}}" alt=""
                     class="img-responsive">
            @else
                <img style="width: 100%; height: 250px;" src="{{url('public/img/frontend/'.$page_info->pic)}}"
                     alt="" class="img-responsive">
            @endif
        </div>
    </div>
    <div class="padding-bottom-mini">
        <!-- Container Area - Boxes Services -->
        <div class="container">

            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="title-subtitle ">
                        <h3 class="page_title text-center center-block"><span>{{$page_title}}</span></h3>
                    </div>
                    <div class="row">
                        @if(sizeof($page_info)==0)
                            <p style="font-size: 16px; font-weight: 600" class="text-center">{{'কোনো তথ্য নেই'}}</p>
                        @else
                            <div class="col-xs-12 col-md-12">
                                <?= $page_info->content?>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Container Area - Boxes Services -->
    </div>
</div>
<!-- End Info Content - Boxes Services-->
@endsection