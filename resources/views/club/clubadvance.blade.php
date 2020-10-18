@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.headerClub")
@endsection

@section("content")

    <!-- breadcrumb Start -->
    <section class="breadcrumbs-custom-wrap">
        <h1 class="text-center">
            <ul class="breadcroumbLink">
                <li><a href="{{ url("/club/home") }}">Home</a></li>
                <li><a>/ advance</a></li>
            </ul>
        </h1>
    </section>

    <!-- banner-section start -->
    <section class="banner-section">
        <div class="banner-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- online-play-tab-part end -->
                        <div class="online-play-tab-part">
                            <ul class="nav customSportsTab" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                                        <i class="flaticon-trophy"></i>
                                        <span>All sports</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cricket-tab" data-toggle="tab" href="#cricket" role="tab" aria-controls="cricket" aria-selected="false">
                                        <i class="flaticon-cricket criCusColor"></i>
                                        <span>cricket</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="football-tab" data-toggle="tab" href="#football" role="tab" aria-controls="football" aria-selected="false">
                                        <i class="flaticon-football footCusColor"></i>
                                        <span>football</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="bascketball-tab" data-toggle="tab" href="#bascketball" role="tab" aria-controls="bascketball" aria-selected="false">
                                        <i class="flaticon-basketball bascketCusColor"></i>
                                        <span>bascketball</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseball-tab" data-toggle="tab" href="#baseball" role="tab" aria-controls="baseball" aria-selected="false">
                                        <i class="flaticon-softball baseCusColor"></i>
                                        <span>volleyball</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tennis-tab" data-toggle="tab" href="#tennis" role="tab" aria-controls="tennis" aria-selected="false">
                                        <i class="flaticon-tennis-racket tennisCusColor"></i>
                                        <span>tennis</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                    @if(!empty($matches))
                                        @foreach($matches as $sportItems)
                                            <div class="sports_single_category">
                                                @if(isset($sportItems[0]["sportName"]))
                                                    <h4 class="text-center">
                                                        @if($sportItems[0]["sportName"] == 'cricket')
                                                            <img src="{{ asset('backend/uploads/users/cricketTwo.png') }}" alt="image" width="20">
                                                        @elseif($sportItems[0]["sportName"] == 'football')
                                                            <img src="{{ asset('backend/uploads/users/football.png') }}" alt="image" width="20">
                                                        @elseif($sportItems[0]["sportName"] == 'basket')
                                                            <img src="{{ asset('backend/uploads/users/basketball.png') }}" alt="image" width="20">
                                                        @elseif($sportItems[0]["sportName"] == 'volley')
                                                            <img src="{{ asset('backend/uploads/users/volley.png') }}" alt="image" width="20">
                                                        @elseif($sportItems[0]["sportName"] == 'tennis')
                                                            <img src="{{ asset('backend/uploads/users/tennis.png') }}" alt="image" width="20">
                                                        @endif
                                                        {{ ucwords($sportItems[0]["sportName"]) }}
                                                    </h4>
                                                @endif
                                                @if($sportItems)
                                                    @foreach($sportItems as $match)
                                                        @if(isset($match["matchOption"]))

                                                            <div class="matchTournamentLiveWrap">
                                                                <div class="matchTournamentDetailPart">
                                                                    <p>
                                                                        {{ ucwords($match["tournamentName"]) }}
                                                                        <span class="badge badge-warning">
                                                                            {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                        </span>
                                                                        <span class="badge badge-danger">
                                                                            {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                        </span>
                                                                    </p>
                                                                    <p>
                                                                        {{ ucwords($match["matchTitle"]) }}
                                                                    </p>
                                                                </div>

                                                                <div class="matchTournamentLivePart">
                                                                    <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                                    @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                        <span class="liveNotification">
                                                                            <b class="liveDot"></b>
                                                                            Live
                                                                        </span>
                                                                        <span class="matchOver"> Over: 35 </span>
                                                                        <span class="matchScores"> Ind : 100/3 </span>
                                                                    @else
                                                                        <span class="upcomingNotification">Upcoming</span>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            @if($match['status'] == 1 || $match['status'] == 2)
                                                                @foreach($match["matchOption"] as $matchesOption)
                                                                    <div class="team-name-part">
                                                                        <div class="content">
                                                                            <span class="name badge badge-dark">{{ ucwords($matchesOption["matchOption"]) }} </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="choice-team-part">
                                                                        @foreach($matchesOption["betDetails"] as $betDetail)
                                                                            <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif  clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                                <span>{{ ucwords($betDetail->betName) }} &nbsp;&nbsp; <b class="text-primary"> @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                            </button>
                                                                        @endforeach
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="cricket" role="tabpanel" aria-labelledby="cricket-tab">
                                    @if(!empty($matches[0]))
                                        <div class="sports_single_category">
                                            @if(isset($matches[0][0]["sportName"]))
                                                <h4 class="text-center">
                                                    @if($matches[0][0]["sportName"] == 'cricket')
                                                        <img src="{{ asset('backend/uploads/users/cricketTwo.png') }}" alt="image" width="20">
                                                    @endif
                                                    {{ ucwords($matches[0][0]["sportName"]) }}
                                                </h4>
                                            @endif
                                            @foreach($matches[0] as $match)

                                                @if(isset($match["matchOption"]))

                                                    <div class="matchTournamentLiveWrap">
                                                        <div class="matchTournamentDetailPart">
                                                            <p>
                                                                {{ ucwords($match["tournamentName"]) }}
                                                                <span class="badge badge-warning">
                                                                    {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                                <span class="badge badge-danger">
                                                                    {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                            </p>
                                                            <p>
                                                                {{ ucwords($match["matchTitle"]) }}
                                                            </p>
                                                        </div>

                                                        <div class="matchTournamentLivePart">
                                                            <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                            @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                <span class="liveNotification">
                                                                    <b class="liveDot"></b>
                                                                    Live
                                                                </span>
                                                                <span class="matchOver"> Over: 35 </span>
                                                                <span class="matchScores"> Ind : 100/3 </span>
                                                            @else
                                                                <span class="upcomingNotification">Upcoming</span>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    @if($match['status'] == 1 || $match['status'] == 2)
                                                        @foreach($match["matchOption"] as $matchesOption)
                                                            <div class="team-name-part">
                                                                <div class="content">
                                                                    <span class="name">{{ ucwords($matchesOption["matchOption"]) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="choice-team-part">
                                                                @foreach($matchesOption["betDetails"] as $betDetail)
                                                                    <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif  clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                        <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary">&nbsp; @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="football" role="tabpanel" aria-labelledby="football-tab">
                                    @if(!empty($matches[1]))
                                        <div class="sports_single_category">
                                            @if(isset($matches[1][0]["sportName"]))
                                                <h4 class="text-center">
                                                    @if($matches[1][0]["sportName"] == 'football')
                                                        <img src="{{ asset('backend/uploads/users/football.png') }}" alt="image" width="20">
                                                    @endif
                                                    {{ ucwords($matches[1][0]["sportName"]) }}
                                                </h4>
                                            @endif
                                            @foreach($matches[1] as $match)

                                                @if(isset($match["matchOption"]))
                                                    <div class="matchTournamentLiveWrap">
                                                        <div class="matchTournamentDetailPart">
                                                            <p>
                                                                {{ ucwords($match["tournamentName"]) }}
                                                                <span class="badge badge-warning">
                                                                    {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                                <span class="badge badge-danger">
                                                                    {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                            </p>
                                                            <p>
                                                                {{ ucwords($match["matchTitle"]) }}
                                                            </p>
                                                        </div>

                                                        <div class="matchTournamentLivePart">
                                                            <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                            @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                <span class="liveNotification">
                                                                    <b class="liveDot"></b>
                                                                    Live
                                                                </span>
                                                                <span class="matchOver"> Over: 35 </span>
                                                                <span class="matchScores"> Ind : 100/3 </span>
                                                            @else
                                                                <span class="upcomingNotification">Upcoming</span>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    @if($match['status'] == 1 || $match['status'] == 2)
                                                        @foreach($match["matchOption"] as $matchesOption)
                                                            <div class="team-name-part">
                                                                <div class="content">
                                                                    <span class="name">{{ ucwords($matchesOption["matchOption"]) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="choice-team-part">
                                                                @foreach($matchesOption["betDetails"] as $betDetail)
                                                                    <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                        <span>{{ ucwords($betDetail->betName) }} &nbsp;&nbsp; <b class="text-primary"> @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="bascketball" role="tabpanel" aria-labelledby="bascketball-tab">
                                    @if(!empty($matches[2]))
                                        <div class="sports_single_category">
                                            @if(isset($matches[2][0]["sportName"]))
                                                <h4 class="text-center">
                                                    @if($matches[2][0]["sportName"] == 'basket')
                                                        <img src="{{ asset('backend/uploads/users/basketball.png') }}" alt="image" width="20">
                                                    @endif
                                                    {{ ucwords($matches[2][0]["sportName"]) }}
                                                </h4>
                                            @endif
                                            @foreach($matches[2] as $match)

                                                @if(isset($match["matchOption"]))
                                                    <div class="matchTournamentLiveWrap">
                                                        <div class="matchTournamentDetailPart">
                                                            <p>
                                                                {{ ucwords($match["tournamentName"]) }}
                                                                <span class="badge badge-warning">
                                                                    {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                                <span class="badge badge-danger">
                                                                    {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                            </p>
                                                            <p>
                                                                {{ ucwords($match["matchTitle"]) }}
                                                            </p>
                                                        </div>

                                                        <div class="matchTournamentLivePart">
                                                            <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                            @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                <span class="liveNotification">
                                                                    <b class="liveDot"></b>
                                                                    Live
                                                                </span>
                                                                <span class="matchOver"> Over: 35 </span>
                                                                <span class="matchScores"> Ind : 100/3 </span>
                                                            @else
                                                                <span class="upcomingNotification">Upcoming</span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    @if($match['status'] == 1 || $match['status'] == 2)
                                                        @foreach($match["matchOption"] as $matchesOption)
                                                            <div class="team-name-part">
                                                                <div class="content">
                                                                    <span class="name">{{ ucwords($matchesOption["matchOption"]) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="choice-team-part">
                                                                @foreach($matchesOption["betDetails"] as $betDetail)
                                                                    <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif  clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                        <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary">&nbsp; @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="baseball" role="tabpanel" aria-labelledby="baseball-tab">
                                    @if(!empty($matches[3]))
                                        <div class="sports_single_category">
                                            @if(isset($matches[3][0]["sportName"]))
                                                <h4 class="text-center">
                                                    @if($matches[3][0]["sportName"] == 'volley')
                                                        <img src="{{ asset('backend/uploads/users/Volley.png') }}" alt="image" width="20">
                                                    @endif
                                                    {{ ucwords($matches[3][0]["sportName"]) }}
                                                </h4>
                                            @endif
                                            @foreach($matches[3] as $match)

                                                @if(isset($match["matchOption"]))
                                                    <div class="matchTournamentLiveWrap">
                                                        <div class="matchTournamentDetailPart">
                                                            <p>
                                                                {{ ucwords($match["tournamentName"]) }}
                                                                <span class="badge badge-warning">
                                                                    {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                                <span class="badge badge-danger">
                                                                    {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                            </p>
                                                            <p>
                                                                {{ ucwords($match["matchTitle"]) }}
                                                            </p>
                                                        </div>

                                                        <div class="matchTournamentLivePart">
                                                            <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                            @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                <span class="liveNotification">
                                                                    <b class="liveDot"></b>
                                                                    Live
                                                                </span>
                                                                <span class="matchOver"> Over: 35 </span>
                                                                <span class="matchScores"> Ind : 100/3 </span>
                                                            @else
                                                                <span class="upcomingNotification">Upcoming</span>
                                                            @endif
                                                        </div>

                                                    </div>

                                                    @if($match['status'] == 1 || $match['status'] == 2)
                                                        @foreach($match["matchOption"] as $matchesOption)
                                                            <div class="team-name-part">
                                                                <div class="content">
                                                                    <span class="name">{{ ucwords($matchesOption["matchOption"]) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="choice-team-part">
                                                                @foreach($matchesOption["betDetails"] as $betDetail)
                                                                    <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif  clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                        <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary">&nbsp; @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="tennis" role="tabpanel" aria-labelledby="tennis-tab">
                                    @if(!empty($matches[4]))
                                        <div class="sports_single_category">
                                            @if(isset($matches[4][0]["sportName"]))
                                                <h4 class="text-center">
                                                    @if($matches[4][0]["sportName"] == 'tennis')
                                                        <img src="{{ asset('backend/uploads/users/tennis.png') }}" alt="profile image" width="20">
                                                    @endif
                                                    {{ ucwords($matches[4][0]["sportName"]) }}
                                                </h4>
                                            @endif
                                            @foreach($matches[4] as $match)

                                                @if(isset($match["matchOption"]))
                                                    <div class="matchTournamentLiveWrap">
                                                        <div class="matchTournamentDetailPart">
                                                            <p>
                                                                {{ ucwords($match["tournamentName"]) }}
                                                                <span class="badge badge-warning">
                                                                    {{ date("d M Y",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                                <span class="badge badge-danger">
                                                                    {{ date("h:i A",strtotime($match["matchDateTime"])) }}
                                                                </span>
                                                            </p>
                                                            <p>
                                                                {{ ucwords($match["matchTitle"]) }}
                                                            </p>
                                                        </div>

                                                        <div class="matchTournamentLivePart">
                                                            <?php date_default_timezone_set('Asia/Dhaka'); $currentDateTime = date("Y-m-d H:i:s"); ?>
                                                            @if($currentDateTime > $match["matchDateTime"] && $match['status'] == 2 || $match['status'] == 3)
                                                                <span class="liveNotification">
                                                                    <b class="liveDot"></b>
                                                                    Live
                                                                </span>
                                                                <span class="matchOver"> Over: 35 </span>
                                                                <span class="matchScores"> Ind : 100/3 </span>
                                                            @else
                                                                <span class="upcomingNotification">Upcoming</span>
                                                            @endif
                                                        </div>

                                                    </div>
                                                    @if($match['status'] == 1 || $match['status'] == 2)
                                                        @foreach($match["matchOption"] as $matchesOption)
                                                            <div class="team-name-part">
                                                                <div class="content">
                                                                    <span class="name">{{ ucwords($matchesOption["matchOption"]) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="choice-team-part">
                                                                @foreach($matchesOption["betDetails"] as $betDetail)
                                                                    <button value="{{ $betDetail->id }}" class="@if(count($matchesOption["betDetails"]) == 2) single-item-for-mobile @else single-item @endif  clickSingleBetDetail" data-target="#placeBetBtn" data-toggle="modal" data-backdrop="static" data-keyboard="false">
                                                                        <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary">&nbsp; @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                                                    </button>
                                                                @endforeach
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <h3 class="bg-warning text-center p-2">No upcoming match</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- online-play-tab-part end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-section end -->

    <!-- Modal -->
    <div class="modal fade" id="placeBetBtn" aria-hidden="true" aria-labelledby="placeBetBtn" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-center">
            <div class="modal-content">
                <div style="display:block;background:#eee;height:58px" class="modal-header">
                    <button id="customModelClose" type="button" class="close bg-warning" data-dismiss="modal" aria-label="Close">
                        <span class="text-secondary fa fa-close" aria-hidden="true"></span>
                    </button>
                    <h4 style="text-align:center" class="modal-title">Place a bet</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="modalCustomBody">
                            @if(!Auth::guard("web")->check())
                                <p class="text-danger text-center" id="errorLogin">["error":"Login First."]</p>
                            @endif

                            <p class="text-danger text-center" id="errorMsg"></p>
                            <p class="text-success text-center" id="successMsg"></p>
                            <p class="text-info text-center" id="processingMsg"></p>

                            <p class="text-success text-center">Minimum Bet Amount {{ $config->betMinimum }} & Maximum {{ $config->betMaximum }}</p>
                            <div class="modalQusAnsBlock">
                                <p style="text-transform: capitalize" class="text-secondary" id="betDetailQus"></p>
                                <p style="text-transform: capitalize" class="text-secondary" id="betDetailAns"></p>
                                <p class="text-secondary">
                                    Bet Rate : <input type="text" name="betRate" id="betDetailRate" value="" readonly/>
                                </p>
                                <input autofocus type="number" name="betAmount" id="betAmount" placeholder="0" value="" min="0"/>
                                <span class="text-secondary">
                                    Est. Return: <input type="text" name="" id="betEstReturn" value="0.00" readonly/>
                                </span>
                                <input type="hidden" id="betMinimum" value="{{ $config->betMinimum }}"/>
                                <input type="hidden" id="betMaximum" value="{{ $config->betMaximum }}"/>
                                <input type="hidden" id="betDetail_id" value=""/>
                                <input type="hidden" id="match_id" value=""/>
                                <input type="hidden" id="betoption_id" value=""/>

                            </div>
                        </div>
                    </div>

                    <div style="display:block;background:#eee" class="modal-footer  text-center">

                        <button class="btn btn-block btn-secondary placeBetSubmitCls" id="placeBetSubmit" disabled="disabled" type="submit" name="placeBet"> Place Bet </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

@endsection

@section("main-footer")
    @include("frontend.partials.footer")
@endsection

@section("main-script")
    @include("frontend.partials.scriptFiles")
@endsection

@section("scriptExtra")
    <script src="{{ asset('/js/clubadvance.js') }}"> </script>
@endsection
