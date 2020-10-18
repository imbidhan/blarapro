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
                <li><a>/ inplay</a></li>
            </ul>
        </h1>
    </section>
    <!-- banner-section start -->
    <section class="banner-section">
        <div class="banner-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
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
                                        <span>volleyball</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseball-tab" data-toggle="tab" href="#baseball" role="tab" aria-controls="baseball" aria-selected="false">
                                        <i class="flaticon-softball baseCusColor"></i>
                                        <span>baseball</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tennis-tab" data-toggle="tab" href="#tennis" role="tab" aria-controls="tennis" aria-selected="false">
                                        <i class="flaticon-tennis-racket tennisCusColor"></i>
                                        <span>tennis</span>
                                    </a>
                                </li>
                            </ul>
                            <div id="appendTab"></div>
                        </div>
                        <!-- online-play-tab-part end -->
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-frontend p-2">
                            <h3><button class="btn btn-block mb-3"> Upcoming </button></h3>

                            @if($upcomingMatches->count() > 0)

                                @foreach($upcomingMatches as $upcomingMatch)
                                    <a href="{{ route("club_single_match_details",["id"=>$upcomingMatch->id]) }}" class="single-match p-2 rounded mb-3">
                                        <p class="text-center text-capitalize mb-1"> <span class="badge badge-sm badge-warning">{{ $upcomingMatch->sport->sportName }} : {{ $upcomingMatch->tournament->tournamentName }}</span></p>
                                        <p class="text-center">
                                            <button class="p-0 btn btn-block btn-dark text-capitalize">{{ $upcomingMatch->teamOne->teamName }}</button>
                                            <span class="text-white">vs</span>
                                            <button class="p-0 btn btn-block btn-secondary text-capitalize">{{ $upcomingMatch->teamTwo->teamName }}</button>
                                        </p>

                                        <p class="text-center">
                                            <span class="badge badge-primary"> {{ date("d M Y",strtotime($upcomingMatch->matchDateTime)) }}  </span>
                                            <span class="badge badge-success"> {{ date("h:i A",strtotime($upcomingMatch->matchDateTime)) }}  </span>
                                        </p>
                                    </a>
                                @endforeach

                            @else
                                <p class="text-center"><span class="badge badge-warning">No Match Upcomming</span></p>
                            @endif
                        </div>
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
                                <input type="number" name="betAmount" id="betAmount" placeholder="0" value="" min="0"/>
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
    <script src="{{ asset('/js/clubinplay.js') }}"> </script>
@endsection
