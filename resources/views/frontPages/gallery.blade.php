@extends('layouts.public')

@section('customCss')
    <link rel='stylesheet' href='{{url('public/')}}/js/libs/unitegallery/css/unite-gallery.css' type='text/css'/>
    <link rel='stylesheet' href='{{url('public/')}}/js/libs/unitegallery/themes/default/ug-theme-default.css'
          type='text/css'/>
    @endsection

    @section('content')
            <!-- Info Content - Boxes Services-->
    <div class="content_info">
        <div class="padding-bottom-mini">
            <!-- Container Area - Boxes Services -->
            <div class="container">
                <div class="row">
                    <div class="form-group ">
                        <h2 class="text-center">তথ্য ও ছবি</h2>
                    </div>
                </div>
                <div class="row" style="text-align: center">
                    @if(sizeof($page_info)==0)
                        <div class="col-md-12">
                            <p>কোনো তথ্য নেই</p>
                        </div>
                    @else
                        <div id="gallery" class="center-block" style="display:none;">
                            @foreach($page_info as $row)
                                <img alt="Preview Image 1"
                                     src="{{url('public/img/gallery/thumbs/'.$row->name)}}"
                                     data-image="{{url('public/img/gallery/big/'.$row->name)}}"
                                     data-description="{{$row->details}}">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <!-- End Container Area - Boxes Services -->
        </div>
    </div>
    <!-- End Info Content - Boxes Services-->
@endsection

@section('customJs')
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-common-libraries.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-functions.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-thumbsgeneral.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-thumbsstrip.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-touchthumbs.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-panelsbase.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-strippanel.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-gridpanel.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-thumbsgrid.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-tiles.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-tiledesign.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-avia.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-slider.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-sliderassets.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-touchslider.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-zoomslider.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-video.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-gallery.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-lightbox.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-carousel.js'></script>
    <script type='text/javascript' src='{{url('public/')}}/js/libs/unitegallery/js/ug-api.js'></script>
    <script type='text/javascript'
            src='{{url('public/')}}/js/libs/unitegallery/themes/default/ug-theme-default.js'></script>
    <script type="text/javascript">

        jQuery(document).ready(function () {

            jQuery("#gallery").unitegallery();

        });

    </script>
@endsection