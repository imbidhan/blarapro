@extends('backend.backendMaster')
@section('title', 'Matches Unpublished')
@section('page_title', 'Matches Unpublished')
@section('page_content')
    <!-- Page -->
    <div class="page">

        <div class="page-content container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-bordered panel-info border border-info">
                        <div class="panel-heading-custom">
                            <h3 class="panel-title-custom">@yield('page_title')</h3>
                        </div>
                        <div class="p-5">
                            <ul class="list-group bg-blue-grey-100 bg-inherit">
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucfirst($match->sport->sportName) }}</span> Sports </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucwords($match->tournament->tournamentName) }}</span> Tournament </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Match title not given @endif</span> Matches Title </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucwords($match->teamOne->teamName) }} VS {{ ucwords($match->teamTwo->teamName) }}</span> Match </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ date("d M y",strtotime($match->matchDateTime)) }} || {{ date("h:i A",strtotime($match->matchDateTime)) }} </span> Match Date Time </li>
                            </ul>
                            <div class="nav-tabs-horizontal" data-plugin="tabs">
                                <ul class="nav nav-tabs nav-tabs-line tabs-line-top" role="tablist">
                                    <li class="nav-item" role="presentation"><a class="nav-link text-dark font-size-16 font-weight-bold active show" data-toggle="tab" href="#betAction" aria-controls="betAction" role="tab" aria-selected="false">Published List</a></li>
                                </ul>
                                <div class="tab-content pt-20">
                                    <div class="tab-pane active show" id="betAction" role="tabpanel">
                                        <div class="panel-group " id="AccordionDefault" aria-multiselectable="true" role="tablist">
                                            <div class="row">
                                                @if(!empty($optionBetDetails))
                                                    @foreach($optionBetDetails as $key=>$optionBetDetail)
                                                        <div class="col-md-4 mb-2">
                                                            <p>{{ ucwords($optionBetDetail['matchOption']) }}</p>
                                                            <form action="{{ route("bet_unpublished_reset") }}" method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <select class="form-control" name="betDetailId">
                                                                        @if($optionBetDetail['betDetails'])
                                                                            <option value=""> Please select </option>
                                                                            @foreach($optionBetDetail['betDetails'] as $key=>$betDetailItem)
                                                                                <option value="{{ $betDetailItem->id }}" >{{ ucfirst($betDetailItem->betName)}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <input type="hidden" name="match_id" value="{{ $optionBetDetail["match_id"] }}" />
                                                                    <input type="hidden" name="betoption_id" value="{{ $optionBetDetail["betoption_id"] }}" />
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="submit" onclick="return confirm('Are you sure to Unpublished?')" class="btn btn-sm btn-dark" value="Unpublished"/>
                                                                </div>

                                                            </form>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <div class="col-md-12 mb-2">
                                                        <h5 class="text-capitalize text-danger text-center">Not found publish item </h5>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
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
    <style type="text/css">
        .panel-heading-custom {
            color: #fff;
            background-color: #011b1b;
            border: none;
        }

        .panel-title-custom {
            display: block;
            padding: 10px 15px;
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
    </style>
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    <script type="text/javascript">
        $('#matchManage').addClass('active open');
        $('#matchManageChildLi').addClass('active');
    </script>
@endsection
