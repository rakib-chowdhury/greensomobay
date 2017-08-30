@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
@endsection
@php
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
@endphp
@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">শাখা</b>
                    <button type="button" data-toggle="modal" data-target="#addBranch"
                            class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> শাখা সংযোজন করুন
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বিভাগ</th>
                            <th>জেলা</th>
                            <th>উপজেলা</th>
                            <th>এলাকা</th>
                            <th>ম্যানেজার</th>
                            <th>কর্মচারী</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        @if(empty($branches))
                            <h3 class="text-danger">No Branches</h3>
                        @else
                            <?php $number = 0; ?>
                            @foreach($branches as $branch)
                                <tr>
                                    <td>{{ str_replace(range(0,9),$bn_digits,++$number) }}</td>
                                    <td class="text-bold">{{ $branch->name }}</td>
                                    <td>{{ $branch->division['name'] }}</td>
                                    <td>{{ $branch->district['bn_name'] }}</td>
                                    <td>{{ $branch->subDistrict['bn_name'] }}</td>
                                    <td>{{ $branch->specified_location }}</td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>
                                        <a  class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                        <a data-toggle="modal" data-target="#editBranch{{$branch->id}}"
                                           class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                        <a href="{{ url('/admin/branch/'.$branch->id.'/delete') }}"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>

                                        <!-----------------------------------------------
                                        * branch edit modal
                                        *----------------------------------------------->
                                        <div class="modal fade" id="editBranch{{$branch->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header padding">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"><i
                                                                    class="fa fa-indent"></i> শাখা সংশোধন</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/admin/branch/update') }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="id" value="{{$branch->id}}">
                                                            <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                                                <label for="name">শাখা নাম</label>
                                                                <input type="text" class="form-control"
                                                                       value="{{$branch->name}}" name="name" id="name"
                                                                       required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 form-group {{ $errors->has('division')?'has-error':'' }}">
                                                                    <label for="division">বিভাগ</label>
                                                                    <select readonly name="division"
                                                                            class="form-control-select division" >
                                                                        @if(empty($divisions))
                                                                            <option value="">No division</option>
                                                                        @else
                                                                            <option value="{{ $divisions->id }}">{{ $divisions->name }}</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 form-group {{ $errors->has('district')?'has-error':'' }}">
                                                                    <label for="district">জেলা</label>
                                                                    <select readonly class="form-control-select district"
                                                                            name="district" id="">
                                                                        @if(empty($districts))
                                                                            <option value="">No district</option>
                                                                        @else
                                                                            <option value="{{ $districts->id }}">{{ $districts->bn_name }}</option>
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 form-group {{ $errors->has('subDistrict')?'has-error':'' }}">
                                                                    <label for="district">উপজেলা</label>
                                                                    <select class="form-control-select subDistrict"
                                                                            name="subDistrict" id="">
                                                                        @if(empty($upazillas))
                                                                            <option value="">No district</option>
                                                                        @else
                                                                            @foreach($upazillas as $upazilla)
                                                                                @if($branch->subDistrict_id==$upazilla->id)
                                                                                    <option selected
                                                                                            value="{{ $upazilla->id }}">{{ $upazilla->bn_name }}</option>
                                                                                @else
                                                                                    <option value="{{ $upazilla->id }}">{{ $upazilla->bn_name }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group {{ $errors->has('specified')?'has-error':'' }}">
                                                                <label for="specified">বিস্তারিত </label>
                                                                <textarea name="specified" id="specified"
                                                                          class="form-control">{{$branch->specified_location}}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                                            class="fa fa-database"></i> সংশোধন করুন
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /end modal for store branch -->
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
                <!-----------------------------------------------
                 * branch Add modal
                 *----------------------------------------------->
                <div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header padding">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-indent"></i> শাখা সংযোজন</h4>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/admin/store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                        <label for="name">শাখা নাম</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group {{ $errors->has('division')?'has-error':'' }}">
                                            <label for="division">বিভাগ</label>
                                            <select readonly name="division" class="form-control-select" id="division">
                                                @if(empty($divisions))
                                                    <option value="">No division</option>
                                                @else
                                                    <option value="{{ $divisions->id }}">{{ $divisions->name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group {{ $errors->has('district')?'has-error':'' }}">
                                            <label for="district">জেলা</label>
                                            <select readonly class="form-control-select" name="district" id="district">
                                                @if(empty($districts))
                                                    <option value="">No district</option>
                                                @else
                                                    <option value="{{ $districts->id }}">{{ $districts->bn_name }}</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group {{ $errors->has('subDistrict')?'has-error':'' }}">
                                            <label for="district">উপজেলা</label>
                                            <select class="form-control-select" name="subDistrict" id="subDistrict">
                                                @if(empty($upazillas))
                                                    <option value="">No district</option>
                                                @else
                                                    @foreach($upazillas as $upazilla)
                                                        <option value="{{ $upazilla->id }}">{{ $upazilla->bn_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('specified')?'has-error':'' }}">
                                        <label for="specified">বিস্তারিত </label>
                                        <textarea name="specified" id="specified" class="form-control"></textarea>
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
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#division').selectize();
            $('#district').selectize();
            $('#subDistrict').selectize();

            $('.division').selectize();
            $('.district').selectize();
            $('.subDistrict').selectize();
        });
    </script>
@endsection