@extends('backend.backendMaster')
@section('title', 'Matches Finish Details')
@section('page_title', 'Matches Finish Details')
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

                    <div class="panel panel-bordered panel-dark border border-dark">
                        <div class="panel-heading-custom">
                            <h3 class="panel-title-custom">@yield('page_title')</h3>
                        </div>
                        <div class="p-5">
                            <ul class="list-group bg-blue-grey-100 bg-inherit">
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucfirst($match->sport->sportName) }}</span> Sports </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Match title not given @endif</span> Matches Title </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucwords($match->teamOne->teamName) }} VS {{ ucwords($match->teamTwo->teamName) }}</span> Match </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ date("d M y",strtotime($match->matchDateTime)) }} || {{ date("h:i A",strtotime($match->matchDateTime)) }} </span> Match Date Time </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucwords($match->tournament->tournamentName) }}</span> Tournament </li>
                                <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">{{ ucfirst($match->userCreated->userRole->name) }} ( <?php  $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC")); echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A'); ?> ) </span> Match added </li>
                            </ul>
                            <div class="nav-tabs-horizontal" data-plugin="tabs">
                                <ul class="nav nav-tabs nav-tabs-line tabs-line-top" role="tablist">
                                    <li class="nav-item" role="presentation"><a class="nav-link active show" data-toggle="tab" href="#details" aria-controls="details" role="tab" aria-selected="true">Details</a></li>
                                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#bets" aria-controls="bets" role="tab" aria-selected="false">Bets</a></li>
                                </ul>
                                <div class="tab-content pt-20">
                                    <div class="tab-pane active show" id="details" role="tabpanel">

                                        <ul class="list-group list-group-dividered">
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($allBetPlaces->count() > 0 ) {{ ($allBetPlaces->count()) }} @else 0 @endif </span> Total bets </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($totalUnpublished->count() > 0 )  {{ ($totalUnpublished->count()) }} @else 0 @endif </span> Total Unpublished Item </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($totalReturn->count() > 0 ) {{ $totalReturn->count() }} @else 0 @endif </span> Total return bets </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($allBetPlaces->count() > 0 )  {{ $allBetPlaces->sum("clubGet") }} @else 0 @endif Tk</span> Club Get </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($totalSponsorGetThisMatch > 0 )  {{ $totalSponsorGetThisMatch }} @else 0 @endif Tk</span> Sponsor Get</li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($allBetPlaces->count() > 0 )  {{ ($allBetPlaces->sum("betProfit")) }} @else 0 @endif Tk</span> User Get </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($allBetPlaces->count() > 0 )  {{ ($allBetPlaces->sum("betAmount")) }} @else 0 @endif Tk </span> Total bet amount </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($totalUnpublished->count() > 0 )  {{ ($totalUnpublished->sum("betAmount")) }} @else 0 @endif Tk </span> Total Unpublished amount </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark"> @if($totalReturn->count() > 0 )  {{ $totalReturn->sum("betAmount") }} @else 0 @endif Tk </span> Total return bet amount </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($totalBackUser->count() > 0 )  {{ ($totalBackUser->sum("betAmount")) }} @else 0 @endif Tk</span> User back </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($allBetPlaces->count() > 0 )  {{ ($allBetPlaces->sum("betLost")) }} @else 0 @endif Tk</span> Site Get </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($allBetPlaces->count() > 0 )  {{ ($allBetPlaces->sum("partialLost")) }} @else 0 @endif Tk</span> Partial Get </li>
                                            <li class="list-group-item blue-grey-500"> <span class="badge badge-pill badge-dark">@if($allBetPlaces->count() > 0 )  ({{ $allBetPlaces->sum("betLost") }} + {{ $allBetPlaces->sum("partialLost") }}) - ({{ $allBetPlaces->sum("betProfit") }} + {{ $allBetPlaces->sum("clubGet") }} + {{ $totalSponsorGetThisMatch }}) =  {{ ($allBetPlaces->sum("betLost") + $allBetPlaces->sum("partialLost")) - ($allBetPlaces->sum("clubGet") + $totalSponsorGetThisMatch + $allBetPlaces->sum("betProfit")) }} @else 0 @endif Tk</span> Total Profit </li>
                                        </ul>

                                    </div>
                                    <div class="tab-pane" id="bets" role="tabpanel">

                                        <table class="table table-bordered table-responsive-md table-responsive-sm">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User</th>
                                                <th>Club</th>
                                                <th width="10%">Bet Option</th>
                                                <th>Bet On</th>
                                                <th>Winner On</th>
                                                <th>Bet Amount</th>
                                                <th>Bet Rate</th>
                                                <th>User Profit</th>
                                                <th>Site Profit</th>
                                                <th>Partial Profit</th>
                                                <th>Partial Rate</th>
                                                <th>User Status</th>
                                                <th>Admin Status</th>
                                                <th width="10%">Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if($allBetPlaces->count() > 0)
                                                @php($i=1)
                                                @foreach($allBetPlaces as $allBetPlace)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $allBetPlace->user->username }}</td>
                                                        <td>{{ $allBetPlace->club->username }}</td>
                                                        <td>{{ ucwords($allBetPlace->betoption->betOptionName) }}</td>
                                                        <td>{{ ucwords($allBetPlace->betdetail->betName) }}</td>
                                                        <td> @if(isset($allBetPlace->winnerItem->betName)) {{ucwords($allBetPlace->winnerItem->betName)  }} @endif</td>
                                                        <td>{{ $allBetPlace->betAmount }}</td>
                                                        <td>{{ $allBetPlace->betRate }}</td>
                                                        <td>{{ $allBetPlace->betProfit }}</td>
                                                        <td>{{ $allBetPlace->betLost }}</td>
                                                        <td>{{ $allBetPlace->partialLost }}</td>
                                                        <td>{{ $allBetPlace->partialRate }}</td>
                                                        <td>
                                                            @if($allBetPlace->winLost == 'match upcoming')
                                                                <span class="badge badge-primary">{{ ucwords($allBetPlace->winLost) }}</span>
                                                            @elseif($allBetPlace->winLost == 'match live')
                                                                <span class="badge badge-success">{{ ucwords($allBetPlace->winLost) }}</span>
                                                            @elseif($allBetPlace->winLost == 'win')
                                                                <span class="badge badge-success">{{ ucwords($allBetPlace->winLost) }}</span>
                                                            @elseif($allBetPlace->winLost == 'lost')
                                                                <span class="badge badge-dark">{{ ucwords($allBetPlace->winLost) }}</span>
                                                            @elseif($allBetPlace->winLost == 'bet return')
                                                                <span class="badge badge-danger">{{ $allBetPlace->winLost }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{ ucwords($allBetPlace->winLost) }} % </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($allBetPlace->status == 0)
                                                                <span class="badge badge-primary">Unpublished</span>
                                                            @else
                                                                <span class="badge badge-success">Published</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if($allBetPlace->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $allBetPlace->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M y h:i A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="15"><h5 class="text-danger text-center">No bet found</h5></td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="p-5">
                                <form action="{{ route("match_details_close_action",["id"=>$match->id]) }}" method="POST" id="matchesDetails" autocomplete="off">
                                    @csrf
                                    <div class="row row-lg">
                                        <div class="col-xl-6 form-horizontal">

                                            <div class="form-group">
                                                <div class="input-group input-group-icon">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"> Action <span class="required text-danger">*</span> </div>
                                                    </div>
                                                    <select class="form-control" id="status" name="status">
                                                        <option class="text-danger font-weight-bold" value="6" @if($match['status'] == 6) selected="selected" @endif>Match Disappear</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-lg">
                                        <div class="form-group col-xl-2 padding-top-m">
                                            <button onclick="return confirm('Are you sure to change action?')"  type="submit" class="btn btn-dark" id="matchDetailsUpdate">Change Match Status</button>
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
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    <style type="text/css">
        .panel-heading-custom {
            color: #fff;
            background-color: #526069;
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
    @include('backend.partials._formvalidation_script')
    <script src="{{ asset('/validation/matchDetails.js') }}"></script>
    <script type="text/javascript">
        $('#matchManage').addClass('active open');
        $('#matchCloseLi').addClass('active');
    </script>

@endsection
