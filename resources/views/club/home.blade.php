@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.headerClub")
@endsection

@section("content")
    <div id="carouselExampleFade" class="carousel slide carousel-fade sliderMainArea" data-ride="carousel">

        <div class="carousel-inner single-custom-item">
            @foreach($slides as $key=>$slide)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img class="slideImg d-block w-100 animated @if($key == 0) zoomIn @elseif($key == 1) zoomIn @elseif($key == 2)  zoomIn @elseif($key == 3)  zoomIn @elseif($key == 4)  zoomIn @endif" src="{{ asset($slide->slideImage) }}" alt="{{ $slide->slideTitle }}">
                    <div class="custom-slider-content">
                        @if($slide->slideTitle)<h2 class="animated @if($key == 0) rollIn @elseif($key == 1)  lightSpeedIn @elseif($key == 2) bounceIn @elseif($key == 3) bounceInDown @elseif($key == 4) bounceInRight @endif" style="animation-delay: 1s">{{ $slide->slideTitle }}</h2>@endif
                        @if($slide->sliderContent)<p class="animated @if($key == 0) rollIn @elseif($key == 1)  lightSpeedIn @elseif($key == 2) bounceIn @elseif($key == 3) bounceInDown @elseif($key == 4) bounceInRight @endif" style="animation-delay: 2s">{{ $slide->sliderContent }}</p>@endif
                        @if($slide->slideBtnText)
                            <a href="@if($slide->slideBtnLink){{ $slide->slideBtnLink }}@endif" target="_blank" class="btn btn-md animated @if($key == 0) btn-warning rollIn @elseif($key == 1) btn-danger lightSpeedIn @elseif($key == 2) btn-info bounceIn @elseif($key == 3) btn-primary bounceInDown @elseif($key == 4) btn-secondary bounceInRight @endif" style="animation-delay: 3s" >{{ $slide->slideBtnText }}</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($slides) > 1)
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <ol class="carousel-indicators SlideCustomBullot">
                @foreach($slides as $key=>$slide)
                    <li data-target="#carouselExampleFade" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>
        @endif
    </div>

    <div class="holder">
        <div class="news">{{ ucwords($config->siteNotice) }}</div>
    </div>

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
                                        <span>bascketball</span>
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
                                <input type="number" name="betAmount" id="betAmount" placeholder="0" value="0" min="0"/>
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

                        <button class="btn btn-block btn-secondary placeBetSubmitCls" id="placeBetSubmit" disabled="disabled"  type="submit" name="placeBet"> Place Bet </button>

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
    <script src="{{ asset('/js/clubhome.js') }}"> </script>
@endsection
