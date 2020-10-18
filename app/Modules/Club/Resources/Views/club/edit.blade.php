@extends('backend.backendMaster')
@section('title', 'Club Edit')
@section('page_title', 'Club Edit')
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
                                        <form action="{{ route('club_update',["id"=>$club->id]) }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf

                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Username
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input readonly type="text" name="username" class="form-control" required placeholder="Username" value="{{ $club->username }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Email
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input readonly type="email" name="email" class="form-control" required placeholder="email" value="{{ $club->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Club Name
                                                                </div>
                                                            </div>
                                                            <input type="text" name="clubName" class="form-control" required placeholder="Club name" value="{{ $club->clubName }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Phone
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="phone" class="form-control" required placeholder="phone" value="{{ $club->phone }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Update</button>
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
    <script src="{{ asset('/validation/clubValidation.js') }}"></script>
    <script type="text/javascript">
        $('#clubManage').addClass('active open');
        $('#clubManageChildLi').addClass('active');
    </script>
@endsection
