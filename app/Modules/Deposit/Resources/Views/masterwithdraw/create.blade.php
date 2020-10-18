@extends('backend.backendMaster')
@section('title', 'Master withdraw create')
@section('page_title', 'Master withdraw create')
@section('page_content')
    <!-- Page -->
    <div class="page">

        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">@yield('page_title')</li>
            </ol>
        </div>

        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-bordered panel-info border border-info">

                        <div class="panel-heading">
                            <h3 class="panel-title">@yield('page_title')</h3>
                        </div>

                        <div class="p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <form action="{{ route('master_withdraw_store') }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Withdraw Amount
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input class="form-control" type="number" name="withdrawAmount" placeholder="Ex:1000.00"  autofocus />

                                                        </div>
                                                        <p class="text-danger">{{ $errors->has('withdrawAmount') ? $errors->first('withdrawAmount') : ' ' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Withdraw</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._formvalidation_style')
@endsection

@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._formvalidation_script')
    {{--<script src="{{ asset('/validation/withdrawMasterValidation.js') }}"></script>--}}
    <script type="text/javascript">
        $('#depositMasterManage').addClass('active open');
        $('#withdrawMasterManageChildLi').addClass('active');
    </script>
@endsection
