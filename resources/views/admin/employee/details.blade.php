@extends('layouts.app')

@section('specifiedCss')
@endsection

@section('content')
    @php
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    @endphp
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">{{$page_title}}</b>
                </div>
                <div class="col-xs-12">
                    <!--general info-->
                    <div class="alert alert-callout alert-success small-padding">সাধারণ তথ্য</div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 form-group">
                            <img style="width: 220px; height: 150px;"
                                 src="{{url('public/img/employee/'.$empInfo[0]->pic)}}" alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted ">
                            <!--id-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>আইডি নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->id_card_no)}}</b>
                                </div>
                            </div>
                            <!--name-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->name)}}</b>
                                </div>
                            </div>
                            <!--nid-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জাতীয় পরিচয়পত্র নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->nid)}}</b>
                                </div>
                            </div>
                            <!--mobie-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>মোবাইল নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->mobile)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--details info-->
                    <div class="alert alert-callout alert-success small-padding">বিস্তারিত তথ্য</div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 form-group">
                            <img style="width: 220px; height: 210px;" src="{{url('public/img/det.png')}}" alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted ">
                            <!--dob-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জন্ম তারিখ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($empInfo[0]->hasEmployeeDetails->dob))
                                            {{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->dob)}}
                                        @else
                                            <br>
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <!--age-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বয়স</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($empInfo[0]->hasEmployeeDetails->dob))
                                            @php
                                            $date1=date_create($empInfo[0]->hasEmployeeDetails->dob);
                                            $crrD=date('Y-m-d');
                                            $date2=date_create($crrD);
                                            $diff=date_diff($date1,$date2);
                                            @endphp
                                            {{str_replace(range(0,9),$bn_digits,$diff->y)}} বছর
                                        @else
                                            <br>
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <!--nationality-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জাতীয়তা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->nationality)}}</b>
                                </div>
                            </div>
                            <!--religion-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>ধর্ম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->religion)}}</b>
                                </div>
                            </div>
                            <!--blood grp-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>রক্তের গ্রূপ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($empInfo[0]->hasEmployeeDetails->hasBloodGroup))
                                            {{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->hasBloodGroup->blood_grp_name)}}
                                        @else
                                            <br>
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <!--education-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>শিক্ষাগত যোগ্যতা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->hasEducation->edu_name)}}</b>
                                </div>
                            </div>
                            <!--marital status-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বৈবাহিক অবস্থা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->maritial_status)}}</b>
                                </div>
                            </div>
                            <!--father name-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>পিতা নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->father_name)}}</b>
                                </div>
                            </div>
                            <!--mpther name-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>মায়ের নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasEmployeeDetails->mother_name)}}</b>
                                </div>
                            </div>
                            <!--curr add-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বর্তমান ঠিকানা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{$empInfo[0]->hasEmployeeDetails->present_address}}</b>
                                </div>
                            </div>
                            <!--permanent add-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>স্থায়ী ঠিকানা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{$empInfo[0]->hasEmployeeDetails->permanent_address}}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--official info-->
                    <div class="alert alert-callout alert-success small-padding">অফিসিয়াল তথ্য</div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 form-group">
                            <img style="width: 220px; height: 210px;"
                                 src="{{url('public/img/ofc.png')}}"
                                 alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted ; min-height: 220px">
                            <!--branch-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>শাখা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasBranch->name)}}</b>
                                </div>
                            </div>
                            <!--join date-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>আবেদনের তারিখ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @php
                                        $applyD = explode(' ',$empInfo[0]->created_at)[0];
                                        @endphp
                                        {{str_replace(range(0,9),$bn_digits,$applyD)}}
                                    </b>
                                </div>
                            </div>
                            <!--des-->
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>পদবী</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$empInfo[0]->hasDesignation->name)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(sizeof($assign_member)!=0)
                            <!--assigned member-->
                    <div class="alert alert-callout alert-success small-padding">নিযুক্তকৃত সদস্য</div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 form-group">
                            <img style="width: 220px; height: 210px;" src="{{url('public/img/member.jpg')}}" alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted; min-height: 210px ">
                            <table class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>সদস্যের ছবি</th>
                                    <th>সদস্যের নাম</th>
                                    <th>সদস্যের ফোন</th>
                                </tr>
                                @foreach($assign_member as $mem_key=>$mem)
                                    <td>{{str_replace(range(0,9),$bn_digits,$mem_key+1)}}</td>
                                    <td><img style="height: 50px; width: 50px;"
                                             src="{{url('public/img/member/'.$mem->hasMember->pic)}}" alt=""></td>
                                    <td>{{$mem->hasMember->name}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$mem->hasMember->phone)}}</td>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    @endif
                </div>

            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datatable/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dynamicTable').DataTable({
                "ordering": false
            });
        });
    </script>
@endsection