@extends('backend.backendMaster')
@section('title', 'Team Edit')
@section('page_title', 'Team edit')
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
                                    <form action="{{ route('team_update',['id' => $team->id]) }}" method="POST" id="exampleFullForm"
                                        autocomplete="off">
                                        @csrf
                                        <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fa fa-soccer-ball-o"
                                                                    aria-hidden="true"></span>
                                                                <span class="required text-danger"> *</span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="teamName"
                                                            placeholder="Team Name" value="{{ $team->teamName }}" autofocus>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fa fa-rocket" aria-hidden="true"></span>
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="sport_id" name="sport_id"
                                                            >
                                                            <option value="">Choose Sports Category</option>
                                                            @if($sports)
                                                                @foreach ($sports as $sport)
                                                                    <option value="{{ $sport->id}}" @if($sport->id == $team->sport_id) selected="selected" @endif>{{ ucfirst($sport->sportName)}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row row-lg">
                                            <div class="form-group col-xl-2 padding-top-m">
                                                <button type="submit" class="btn btn-info" id="validateButton1">Update
                                                    Team</button>
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
<script src="{{ asset('/validation/teamValidation.js') }}"></script>
<script type="text/javascript">
    $('#teamManage').addClass('active open');
    $('#teamManageChildLi').addClass('active');
</script>
@endsection
