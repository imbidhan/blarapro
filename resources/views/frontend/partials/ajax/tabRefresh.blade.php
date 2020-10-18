
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

                                <div  class="matchTournamentLiveWrap">
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
                                                @if($match["overs"] != null)
                                                    <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                                @endif
                                                @if($match["score"] != null)
                                                    <span class="matchScores">{{ $match["score"] }}</span>
                                                @endif
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
                                                    <span>{{ ucwords($betDetail->betName) }}  &nbsp; <b class="text-primary"> @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
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
            <h3 class="bg-warning text-center p-2">No live match</h3>
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
                                        @if($match["overs"] != null)
                                            <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                        @endif
                                        @if($match["score"] != null)
                                            <span class="matchScores">{{ $match["score"] }}</span>
                                        @endif
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
                                            <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary"> @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                        </button>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </div>
        @else
            <h3 class="bg-warning text-center p-2">No live match</h3>
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
                                        @if($match["overs"] != null)
                                            <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                        @endif
                                        @if($match["score"] != null)
                                            <span class="matchScores">{{ $match["score"] }}</span>
                                        @endif
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
            <h3 class="bg-warning text-center p-2">No live match</h3>
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
                                        @if($match["overs"] != null)
                                            <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                        @endif
                                        @if($match["score"] != null)
                                            <span class="matchScores">{{ $match["score"] }}</span>
                                        @endif
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
                                            <span>{{ ucwords($betDetail->betName) }} &nbsp; <b class="text-primary"> @if($betDetail->status == 0) $  @else {{ $betDetail->betRate }} @endif </b> </span>
                                        </button>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </div>
        @else
            <h3 class="bg-warning text-center p-2">No live match</h3>
        @endif
    </div>
    <div class="tab-pane fade" id="baseball" role="tabpanel" aria-labelledby="baseball-tab">
        @if(!empty($matches[3]))
            <div class="sports_single_category">
                @if(isset($matches[3][0]["sportName"]))
                    <h4 class="text-center">
                        @if($matches[3][0]["sportName"] == 'volley')
                            <img src="{{ asset('backend/uploads/users/volley.png') }}" alt="image" width="20">
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
                                        @if($match["overs"] != null)
                                            <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                        @endif
                                        @if($match["score"] != null)
                                            <span class="matchScores">{{ $match["score"] }}</span>
                                        @endif
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
            <h3 class="bg-warning text-center p-2">No live match</h3>
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
                                        @if($match["overs"] != null)
                                            <span class="matchOver"> Over: {{ $match["overs"] }} </span>
                                        @endif
                                        @if($match["score"] != null)
                                            <span class="matchScores">{{ $match["score"] }}</span>
                                        @endif
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
            <h3 class="bg-warning text-center p-2">No live match</h3>
        @endif
    </div>
</div>

<script>
    $(document).ready(function(){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(".clickSingleBetDetail").click(function(e){
            e.preventDefault();

            /*Modal Only close by clicking close icon , that king of protection here*/
            $('#placeBetBtn').modal({backdrop: 'static', keyboard: false});

            var betDetailId   = $(this).val();
            var base_url = window.location.origin;
            var redirect_url = base_url + '/show/single/bet/detail/' + betDetailId;

            $.ajax({
                type: 'GET',
                url: redirect_url,
                data: {
                    _token: CSRF_TOKEN,
                    betDetailId:$(this).val()
                },
                dataType: 'JSON',
                success: function (data) {
                    $("#betAmount").val("");
                    $("#betDetailQus").text("");
                    $("#betDetailAns").text("");
                    $("#betDetailRate").val("");
                    $("#betEstReturn").val("");
                    $("#betDetail_id").val();
                    $("#match_id").val();
                    $("#betoption_id").val();

                    $("#betDetail_id").val(data.id);
                    $("#match_id").val(data.match_id);
                    $("#betoption_id").val(data.betoption_id);

                    $("#betDetailQus").append("Q: "+ data.betoption.betOptionName);
                    $("#betDetailAns").append("A: "+ data.betName);
                    $("#betDetailRate").val(data.betRate);
                    $("#betEstReturn").val(parseFloat(parseInt(0)*parseFloat(data.betRate)).toFixed(2));

                }
            });
        });
    });
</script>
