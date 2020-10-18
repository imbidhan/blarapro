@extends('backend.backendMaster')
@section('title', 'Matches List')
@section('page_title', 'Matches List')
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
                    <div class="panel panel-bordered panel-success border border-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">IP Details</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    {{ $userLocationInfo }}
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
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#matchManage').addClass('active open');
        $('#matchIp').addClass('active');
    </script>
@endsection
