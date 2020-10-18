@extends('backend.backendMaster')
@section('title', 'Live matches Score update')
@section('page_title', 'Live matches Score update')
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

                    <div class="panel panel-bordered panel-dark border border-success">
                        <div class="panel-heading-custom" style="background:#11c26d ">
                            <h3 class="panel-title-custom"><span class="liveNotification"><b class="liveDot"></b>Live Score</span> {{ $score->match->teamOne->teamName }} Vs {{ $score->match->teamTwo->teamName }}</h3>
                        </div>
                        <div class="p-5">
                            <form action="{{ route('matches_live_score_update',['id'=> $score->id])}}" method="POST"
                                  id="exampleFullForm" autocomplete="off">
                                @csrf
                                <div class="row row-lg">
                                    <div class="col-xl-6 form-horizontal">
                                        @if($score->match->sport_id == 1)
                                            <div class="form-group">
                                                <div class="input-group input-group-icon">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            Overs
                                                            <span class="required text-danger"> *</span>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" name="overs" value="@if($score->overs){{ $score->overs }}@endif" required>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <div class="input-group input-group-icon">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        Score Card
                                                        <span class="required text-danger"> *</span>
                                                    </div>
                                                </div>
                                                <textarea class="form-control" name="score" required>@if($score->score){{ $score->score}}@endif</textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="row row-lg">
                                    <div class="form-group col-xl-2 padding-top-m">
                                        <button type="submit" class="btn btn-success" id="validateButton1">Update Score</button>
                                    </div>
                                </div>

                            </form>
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
    <style type="text/css">

        .panel-heading-custom {
            color: #fff;
            background-color: #0bb2d4;
            border: none;
            height:50px
        }

        .panel-title-custom {
            display: block;
            padding: 13px 15px;
            margin-top: 0px;
            margin-bottom: 0;
            font-size: 18px;
            color: #fff;
        }

        .CustomInputTextStyle {
            border: 1px solid #ddd;
            border-radius: 5px;
            height: 35px;
            padding: 5px 10px;
            width: 130px;
        }

        .wrap-option {
            display: none;
        }

        .liveNotification {
            background: #ff3952;
            border-radius: 5px;
            padding: 3px 8px;
            margin-top: -6px;
            position: relative;
            padding-left: 15px;
        }
        .liveDot {
            width: 5px;
            height: 5px;
            color: red;
            background: red;
            position: absolute;
            border-radius: 5px;
            left: 6px;
            top: 12px;
            animation: customZoomIn 2s infinite;
        }
        @keyframes customZoomIn {
            /* You could think of as "step 1" */
            0% {
                background: #ffffff;
            }
            /* You could think of as "step 2" */
            100% {
                background: #ff3952;
            }
        }
    </style>
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._formvalidation_script')
    <script src="{{ asset('/validation/matchesValidation.js') }}"></script>
@endsection
