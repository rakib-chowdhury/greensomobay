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
                                 src="{{url('public/img/member/'.$memberInfo[0]->pic)}}" alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted ">
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>রেজিষ্ট্রেশন নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->registration_no)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->name)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জাতীয় পরিচয়পত্র নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->nid)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>মোবাইল নং</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->phone)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>পেশা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->occupation)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বর্তমান ঠিকানা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        <span style="padding-right: 25px;">বিভাগ</span>: {{$memberInfo[0]->hasMemberDetails->hasCurrDivision->name}}
                                        <br><span
                                                style="padding-right: 29px;">জেলা</span>: {{$memberInfo[0]->hasMemberDetails->hasCurrDistrict->bn_name}}
                                        <br><span
                                                style="padding-right: 5px;">উপজেলা</span>: {{$memberInfo[0]->hasMemberDetails->hasCurrUpz->bn_name}}
                                        <br><span
                                                style="padding-right: 17px;">ডাকঘর</span>: {{$memberInfo[0]->hasMemberDetails->current_postoffice}}
                                        <br><span
                                                style="padding-right: 40px;">গ্রাম</span>: {{$memberInfo[0]->hasMemberDetails->current_location}}
                                    </b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>শাখা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasBranch->name)}}</b>
                                </div>
                            </div>
                            @if(sizeof($assign_emp)!=0)
                                <div class="col-sm-12 form-group">
                                    <div class="col-xs-12 col-sm-4">
                                        <span>নিযুক্তকৃত কর্মচারী</span>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 view-details">
                                        <b>{{str_replace(range(0,9),$bn_digits,($assign_emp[0]->hasEmployee->name.'('.$assign_emp[0]->hasEmployee->mobile.')'))}}</b>
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>আবেদনের তারিখ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @php
                                        $applyD = explode(' ',$memberInfo[0]->created_at)[0];
                                        @endphp
                                        {{str_replace(range(0,9),$bn_digits,$applyD)}}
                                    </b>
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
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জন্ম তারিখ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($memberInfo[0]->hasMemberDetails->birth_date))
                                            {{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->birth_date)}}
                                        @else
                                            <br>
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বয়স</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($memberInfo[0]->hasMemberDetails->birth_date))
                                            @php
                                            $date1=date_create($memberInfo[0]->hasMemberDetails->birth_date);
                                            $crrD=date('Y-m-d');
                                            $date2=date_create($crrD);
                                            $diff=date_diff($date1,$date2);
                                            @endphp
                                            {{str_replace(range(0,9),$bn_digits,$diff->y)}} বছর</b>
                                    @else
                                        <br>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>লিঙ্গ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{$memberInfo[0]->hasMemberDetails->gender}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>জাতীয়তা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->nationality)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>ধর্ম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->religion)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>রক্তের গ্রূপ</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        @if(!empty($memberInfo[0]->hasMemberDetails->hasBloodGroup))
                                            {{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->hasBloodGroup->blood_grp_name)}}
                                        @else
                                            <br>
                                        @endif
                                    </b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>শিক্ষাগত যোগ্যতা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->hasEducation->edu_name)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>বৈবাহিক অবস্থা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->marital_status)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>পিতা/স্বামীর নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->guardian_name)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>পিতা/স্বামীর পেশা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->guardian_occupation)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>মায়ের নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->mother_name)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>মায়ের পেশা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->mother_occupation)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>স্থায়ী ঠিকানা</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>
                                        <span style="padding-right: 25px;">বিভাগ</span>: {{$memberInfo[0]->hasMemberDetails->hasPerDivision->name}}
                                        <br><span
                                                style="padding-right: 29px;">জেলা</span>: {{$memberInfo[0]->hasMemberDetails->hasCurrDistrict->bn_name}}
                                        <br><span
                                                style="padding-right: 6px;">উপজেলা</span>: {{$memberInfo[0]->hasMemberDetails->hasCurrUpz->bn_name}}
                                        <br><span
                                                style="padding-right: 17px;">ডাকঘর</span>: {{$memberInfo[0]->hasMemberDetails->current_postoffice}}
                                        <br><span
                                                style="padding-right: 40px;">গ্রাম</span>: {{$memberInfo[0]->hasMemberDetails->current_location}}
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--nominee info-->
                    <div class="alert alert-callout alert-success small-padding">নমিনী</div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-12 form-group">
                            <img style="width: 220px; height: 150px;"
                                 src="{{url('public/img/member/'.$memberInfo[0]->hasMemberDetails->nominee_picture)}}"
                                 alt="">
                        </div>
                        <div class="col-sm-7 form-group" style="border-left: 1px dotted ; height: 180px;">
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>নাম</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->nominee_name)}}</b>
                                </div>
                            </div>
                            <div class="col-sm-12 form-group">
                                <div class="col-xs-12 col-sm-4">
                                    <span>সম্পর্ক</span>
                                </div>
                                <div class="col-xs-12 col-sm-8 view-details">
                                    <b>{{str_replace(range(0,9),$bn_digits,$memberInfo[0]->hasMemberDetails->nominee_relation)}}</b>
                                </div>
                            </div>
                        </div>
                    </div>

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