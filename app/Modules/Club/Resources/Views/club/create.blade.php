@extends('backend.backendMaster')
@section('title', 'Club Create')
@section('page_title', 'Club Create')
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
                                        <form action="{{ route('club_store') }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf

                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Club Name
                                                                </div>
                                                            </div>
                                                            <input type="text" name="clubName" class="form-control" required placeholder="Club name">
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
                                                                    Username
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="username" class="form-control" required placeholder="Username">
                                                        </div>
                                                        <p class="text-danger text-left">Allowed character: a-b, A-B , 0-9, -, _</p>
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
                                                            <input type="email" name="email" class="form-control" required placeholder="Email">
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
                                                                    Password
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input type="text" name="password" class="form-control" required placeholder="password" value="12345678" readonly>
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
                                                            <input type="text" name="phone" class="form-control" required placeholder="Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Submit</button>
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
