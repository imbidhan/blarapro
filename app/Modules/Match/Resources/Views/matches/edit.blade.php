@extends('backend.backendMaster')
@section('title', 'Matches Edit')
@section('page_title', 'Matches edit')
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
                                    <form action="{{ route('matches_update',['id'=> $match->id])}}" method="POST"
                                        id="exampleFullForm" autocomplete="off">
                                        @csrf
                                        <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Match Title
                                                                <span class="required text-danger"> *</span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="matchTitle" value="@if($match->matchTitle){{ $match->matchTitle}}@endif" required>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Choose Sports
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="sport_id" name="sport_id"
                                                            data-plugin="select2">
                                                            <option value="">Select Sports</option>
                                                            @if($sports)
                                                            @foreach ($sports as $sport)
                                                            <option value="{{ $sport->id}}" @if($match->sport_id ==
                                                                $sport->id) selected="selected" @endif >
                                                                {{ ucfirst($sport->sportName)}}
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Choose tournament
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="tournament_id"
                                                            name="tournament_id" data-plugin="select2">
                                                            <option value="">Select Tournament</option>
                                                            <option value="{{ $match->tournament_id}}"
                                                                selected="selected">
                                                                {{ ucfirst($match->tournament->tournamentName)}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Choose  Home Team
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="teamOne_id" name="teamOne_id"
                                                            data-plugin="select2">
                                                            <option value="">Select Home Team </option>
                                                            <option value="{{ $match->teamOne_id}}" selected="selected">
                                                                {{ ucfirst($match->teamOne->teamName)}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Choose Guest Team
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="teamTwo_id" name="teamTwo_id"
                                                            data-plugin="select2">
                                                            <option value="">Select Guest Team </option>
                                                            <option value="{{ $match->teamTwo_id}}" selected="selected">
                                                                {{ ucfirst($match->teamTwo->teamName)}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                Match Date Time
                                                                <span class="required text-danger"> *</span>
                                                            </div>
                                                        </div>
                                                        <input type="datetime-local" class="form-control" name="matchDateTime" value="{{ date('Y-m-d\TH:i', strtotime($match->matchDateTime)) }}" required>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row row-lg">
                                            <div class="form-group col-xl-2 padding-top-m">
                                                <button type="submit" class="btn btn-info" id="validateButton1">Update
                                                    Matches</button>
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
<link rel="stylesheet" type="text/css" href="{{ asset("/select2/select2.min.css")}}" />
@endsection


@section('page_scripts')
@include('backend.partials._scripts')
@include('backend.partials._formvalidation_script')
<script src="{{ asset('/select2/select2.min.js') }}"></script>
<script src="{{ asset('/validation/matchesValidation.js') }}"></script>
<script type="text/javascript">
    $('#matchManage').addClass('active open');
    $('#matchManageChildLi').addClass('active');
</script>

<script type="text/javascript">
    $('#sport_id').change(function(){
        var id = $("#sport_id :selected").val();
        var base_url = window.location.origin;
        var redirect_url = base_url + '/admin/matches/change/sports/' + id;

        $.get(redirect_url, function (data) {
            $("#tournament_id").empty();
            $("#tournament_id").append(data.appendTournament);

            $("#teamOne_id").empty();
            $("#teamOne_id").append(data.appendTeam);

            $("#teamTwo_id").empty();
            $("#teamTwo_id").append(data.appendTeam);
        });

    });
</script>
@endsection
