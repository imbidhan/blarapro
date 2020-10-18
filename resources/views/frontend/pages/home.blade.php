@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.header")
@endsection

@section("content")
    <div id="carouselExampleFade" class="carousel slide carousel-fade sliderMainArea" data-ride="carousel">

        <div class="carousel-inner single-custom-item">
            @foreach($slides as $key=>$slide)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img class="slideImg d-block w-100 animated @if($key == 0) zoomIn @elseif($key == 1) zoomIn @elseif($key == 2)  zoomIn @elseif($key == 3)  zoomIn @elseif($key == 4)  zoomIn @endif" src="{{ asset($slide->slideImage) }}" alt="{{ $slide->slideTitle }}">
                    <div class="custom-slider-content">
                        @if($slide->slideTitle)<h2 class="animated @if($key == 0) lightSpeedIn @elseif($key == 1) rollIn @elseif($key == 2) bounceIn @elseif($key == 3) bounceInDown @elseif($key == 4) bounceInRight @endif" style="animation-delay: 1s">{{ $slide->slideTitle }}</h2>@endif
                        @if($slide->sliderContent)<p class="animated @if($key == 0) lightSpeedIn @elseif($key == 1) rollIn @elseif($key == 2) bounceIn @elseif($key == 3) bounceInDown @elseif($key == 4) bounceInRight @endif" style="animation-delay: 2s">{{ $slide->sliderContent }}</p>@endif
                        @if($slide->slideBtnText)
                            <a href="@if($slide->slideBtnLink){{ $slide->slideBtnLink }}@endif" target="_blank" class="btn btn-md animated @if($key == 0) btn-warning lightSpeedIn @elseif($key == 1) btn-danger rollIn @elseif($key == 2) btn-info bounceIn @elseif($key == 3) btn-primary bounceInDown @elseif($key == 4) btn-secondary bounceInRight @endif" style="animation-delay: 3s" >{{ $slide->slideBtnText }}</a>
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
    <section class="banner-section" id="app">
        <div class="banner-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <example-component></example-component>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-frontend p-2">
                            <h3><button class="btn btn-block mb-3"> Upcoming </button></h3>

                            @if($upcomingMatches->count() > 0)

                            @foreach($upcomingMatches as $upcomingMatch)
                                <a href="{{ route("single_match_details",["id"=>$upcomingMatch->id]) }}" class="single-match p-2 rounded mb-3">
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

@endsection

@section("main-footer")
    @include("frontend.partials.footer")
@endsection

@section("main-script")
    <script src="{{ asset('/js/frontendhomes.js') }}"> </script>
    <script src="{{ asset("/js/app.js") }}"></script>
    <!--<script src="{{ asset("/js/frontcheck.js") }}"></script>-->
@endsection
