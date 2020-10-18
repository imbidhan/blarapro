@extends('backend.backendMaster')
@section('page_content')

    <!-- Page -->
    <div class="page">
        <div class="page-content">

            <div class="row">
                @if(Auth::guard("admin")->user()->type != 3)
                <div class="col-lg-3">
                    <!-- Card -->
                    <div class="card card-block p-30 bg-blue-600">
                        <div class="card-watermark darker font-size-80 m-15"><i class="icon wb-user" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-group">
                                <span class="counter-number">{{ $onlineUserCount }}</span>
                                <span class="counter-number-related text-capitalize">User</span>
                            </div>
                            <div class="counter-label text-capitalize">in online</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-3">
                    <!-- Card  -->
                    <div class="card card-block p-30 bg-purple-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon wb-user-add" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{ $todayNewUser }}</span>
                                <span class="counter-number-related text-capitalize">Today</span>
                            </div>
                            <div class="counter-label text-capitalize">new Users</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-3">
                    <!-- Card -->
                    <div class="card card-block p-30 bg-red-600">
                        <div class="card-watermark darker font-size-80 m-15"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-group">
                                <span class="counter-number">@if($todayBetUserCount->count()>0) {{ $todayBetUserCount->count() }} @else 0 @endif</span>
                                <span class="counter-number-related text-capitalize">Bet user</span>
                            </div>
                            <div class="counter-label text-capitalize">New bet user today</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-3">
                <!-- Card -->
                <div class="card card-block p-30 bg-green-600">
                    <div class="card-watermark darker font-size-60 m-15"><i class="icon wb-add-file" aria-hidden="true"></i></div>
                    <div class="counter counter-md counter-inverse text-left">
                        <div class="counter-number-group">
                            <span class="counter-number">{{ $todayMatchCount }}</span>
                            <span class="counter-number-related text-capitalize">Match</span>
                        </div>
                        <div class="counter-label text-capitalize">Today match number</div>
                    </div>
                </div>
                <!-- End Card -->
                </div>
                <div class="col-lg-3">
                    <!-- Card  -->
                    <div class="card card-block p-30 bg-blue-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon wb-user-add" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{ $tomorrowMatchCount }}</span>
                                <span class="counter-number-related text-capitalize">Match</span>
                            </div>
                            <div class="counter-label text-capitalize">Tomorrow match number</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                @endif
                
                <div class="col-lg-3">
                    <!-- Card  -->
                    <div class="card card-block p-30 bg-purple-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon wb-user-add" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{ $todayDeposit }}</span>
                                <span class="counter-number-related text-capitalize">$</span>
                            </div>
                            <div class="counter-label text-capitalize">Today Deposit</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-3">
                    <!-- Card  -->
                    <div class="card card-block p-30 bg-red-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon wb-user-add" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{ $todayCoinToCoin }}</span>
                                <span class="counter-number-related text-capitalize">$</span>
                            </div>
                            <div class="counter-label text-capitalize">Today Coin to coin</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-3">
                    <!-- Card  -->
                    <div class="card card-block p-30 bg-green-600">
                        <div class="card-watermark lighter font-size-60 m-15"><i class="icon wb-user-add" aria-hidden="true"></i></div>
                        <div class="counter counter-md counter-inverse text-left">
                            <div class="counter-number-wrap font-size-30">
                                <span class="counter-number">{{ $todayUnpaid }}</span>
                                <span class="counter-number-related text-capitalize">$</span>
                            </div>
                            <div class="counter-label text-capitalize">Today Unpaid</div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>
            @if(Auth::guard("admin")->user()->type != 3)
            @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' || Auth::guard("admin")->user()->userRole->name == 'mainAdmin')
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-green-600 text-white">Live Cricket</h4>
                </div>
                @if($criLives->count() > 0)
                    @foreach($criLives as $criLive)
                    <div class="col-lg-4">
                        <div class="card card-block p-10 pt-25 pb-25 bg-green-600" style="border:5px dotted #fff">
                            <div class="counter counter-lg counter-inverse">
                                <div class="counter-label text-uppercase font-size-14">@if($criLive->teamOne && $criLive->teamTwo){{ $criLive->teamOne }} vs {{ $criLive->teamTwo }} @endif</div>
                                <div class="counter-label text-lowercase font-size-12 mb-2">@if($criLive->matchTitle){{ $criLive->matchTitle }}@else No Title Given @endif</div>

                                <div>
                                    <b class="btn btn-xs btn-dark mt-1 font-size-12 mb-2">
                                        @if($criLive->matchDateTime) {{ date("d M y h:i A",strtotime($criLive->matchDateTime)) }} @endif
                                    </b>
                                </div>
                                <span class="liveNotification"><b class="liveDot"></b>Live Room</span>
                                <div>
                                    <a class="btn btn-xs btn-warning mt-2 text-uppercase" href="{{ route('live_matches_betrate_view',['id'=>$criLive->id,'score_id'=>$criLive->score_id])}}">Match</a>
                                    {{--<a class="btn btn-xs btn-danger mt-2 text-uppercase" href="{{ route('matches_live_score_view',['id'=>$liveMatch->score_id])}}">Score</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No live cricket</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-primary-600 text-white">Live Football</h4>
                </div>
                @if($footballLives->count() > 0)
                    @foreach($footballLives as $footballLive)
                        <div class="col-lg-4">
                            <div class="card card-block p-10 pt-25 pb-25 bg-primary-600" style="border:5px dotted #fff">
                                <div class="counter counter-lg counter-inverse">
                                    <div class="counter-label text-uppercase font-size-14">@if($footballLive->teamOne && $footballLive->teamTwo){{ $footballLive->teamOne }} vs {{ $footballLive->teamTwo }} @endif</div>
                                    <div class="counter-label text-lowercase font-size-12 mb-2">@if($footballLive->matchTitle){{ $footballLive->matchTitle }}@else No Title Given @endif</div>

                                    <div>
                                        <b class="btn btn-xs btn-dark mt-1 font-size-12 mb-2">
                                            @if($footballLive->matchDateTime) {{ date("d M y h:i A",strtotime($footballLive->matchDateTime)) }} @endif
                                        </b>
                                    </div>
                                    <span class="liveNotification"><b class="liveDot"></b>Live Room</span>
                                    <div>
                                        <a class="btn btn-xs btn-warning mt-2 text-uppercase" href="{{ route('live_matches_betrate_view',['id'=>$footballLive->id,'score_id'=>$footballLive->score_id])}}">Match</a>
                                        {{--<a class="btn btn-xs btn-danger mt-2 text-uppercase" href="{{ route('matches_live_score_view',['id'=>$liveMatch->score_id])}}">Score</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No live football</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-danger text-white">Live Basket</h4>
                </div>
                @if($basketLives->count() > 0)
                    @foreach($basketLives as $basketLive)
                        <div class="col-lg-4">
                            <div class="card card-block p-10 pt-25 pb-25 bg-danger" style="border:5px dotted #fff">
                                <div class="counter counter-lg counter-inverse">
                                    <div class="counter-label text-uppercase font-size-14">@if($basketLive->teamOne && $basketLive->teamTwo){{ $basketLive->teamOne }} vs {{ $basketLive->teamTwo }} @endif</div>
                                    <div class="counter-label text-lowercase font-size-12 mb-2">@if($basketLive->matchTitle){{ $basketLive->matchTitle }}@else No Title Given @endif</div>

                                    <div>
                                        <b class="btn btn-xs btn-dark mt-1 font-size-12 mb-2">
                                            @if($basketLive->matchDateTime) {{ date("d M y h:i A",strtotime($basketLive->matchDateTime)) }} @endif
                                        </b>
                                    </div>
                                    <span class="liveNotification"><b class="liveDot"></b>Live Room</span>
                                    <div>
                                        <a class="btn btn-xs btn-warning mt-2 text-uppercase" href="{{ route('live_matches_betrate_view',['id'=>$basketLive->id,'score_id'=>$basketLive->score_id])}}">Match</a>
                                        {{--<a class="btn btn-xs btn-danger mt-2 text-uppercase" href="{{ route('matches_live_score_view',['id'=>$liveMatch->score_id])}}">Score</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No live basket</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-orange-600 text-white">Live Volley</h4>
                </div>
                @if($volleyLives->count() > 0)
                    @foreach($volleyLives as $volleyLive)
                        <div class="col-lg-4">
                            <div class="card card-block p-10 pt-25 pb-25 bg-orange-600" style="border:5px dotted #fff">
                                <div class="counter counter-lg counter-inverse">
                                    <div class="counter-label text-uppercase font-size-14">@if($volleyLive->teamOne && $volleyLive->teamTwo){{ $volleyLive->teamOne }} vs {{ $volleyLive->teamTwo }} @endif</div>
                                    <div class="counter-label text-lowercase font-size-12 mb-2">@if($volleyLive->matchTitle){{ $volleyLive->matchTitle }}@else No Title Given @endif</div>

                                    <div>
                                        <b class="btn btn-xs btn-dark mt-1 font-size-12 mb-2">
                                            @if($volleyLive->matchDateTime) {{ date("d M y h:i A",strtotime($volleyLive->matchDateTime)) }} @endif
                                        </b>
                                    </div>
                                    <span class="liveNotification"><b class="liveDot"></b>Live Room</span>
                                    <div>
                                        <a class="btn btn-xs btn-warning mt-2 text-uppercase" href="{{ route('live_matches_betrate_view',['id'=>$volleyLive->id,'score_id'=>$volleyLive->score_id])}}">Match</a>
                                        {{--<a class="btn btn-xs btn-danger mt-2 text-uppercase" href="{{ route('matches_live_score_view',['id'=>$liveMatch->score_id])}}">Score</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No live Volley</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-brown-600 text-white">Live Tennis</h4>
                </div>
                @if($tennisLives->count() > 0)
                    @foreach($tennisLives as $tennisLive)
                        <div class="col-lg-4">
                            <div class="card card-block p-10 pt-25 pb-25 bg-brown-600" style="border:5px dotted #fff">
                                <div class="counter counter-lg counter-inverse">
                                    <div class="counter-label text-uppercase font-size-14">@if($tennisLive->teamOne && $tennisLive->teamTwo){{ $tennisLive->teamOne }} vs {{ $tennisLive->teamTwo }} @endif</div>
                                    <div class="counter-label text-lowercase font-size-12 mb-2">@if($tennisLive->matchTitle){{ $tennisLive->matchTitle }}@else No Title Given @endif</div>

                                    <div>
                                        <b class="btn btn-xs btn-dark mt-1 font-size-12 mb-2">
                                            @if($tennisLive->matchDateTime) {{ date("d M y h:i A",strtotime($tennisLive->matchDateTime)) }} @endif
                                        </b>
                                    </div>
                                    <span class="liveNotification"><b class="liveDot"></b>Live Room</span>
                                    <div>
                                        <a class="btn btn-xs btn-warning mt-2 text-uppercase" href="{{ route('live_matches_betrate_view',['id'=>$tennisLive->id,'score_id'=>$tennisLive->score_id])}}">Match</a>
                                        {{--<a class="btn btn-xs btn-danger mt-2 text-uppercase" href="{{ route('matches_live_score_view',['id'=>$liveMatch->score_id])}}">Score</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No live tennis</p>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="p-10 bg-grey-800 text-white">Upcoming All</h4>
                </div>
                @if($upcomingMatches->count() > 0)
                    @foreach($upcomingMatches as $upcomingMatche)
                        <div class="col-lg-3">
                            <div class="card card-block p-10 pt-25 pb-25 bg-grey-600" style="border:5px dotted #fff">
                                <div class="counter counter-lg counter-inverse">
                                    <div class="counter-label text-uppercase font-size-14">@if($upcomingMatche->teamOne && $upcomingMatche->teamTwo){{ $upcomingMatche->teamOne }} vs {{ $upcomingMatche->teamTwo }} @endif</div>
                                    <div class="counter-label text-lowercase font-size-12 mb-2">@if($upcomingMatche->matchTitle){{ $upcomingMatche->matchTitle }}@else No Title Given @endif</div>
                                    <div><a class="btn btn-sm btn-warning mt-2 text-uppercase" href="{{ route('matches_manage')}}">Upcoming</a></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <p class="text-capitalize text-center text-danger font-weight-bold">No Upcoming</p>
                    </div>
                @endif
            </div>
            @endif
            @endif
        </div>

    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    <style>
        .liveNotification {
            background: #ff3952;
            border-radius: 5px;
            padding: 7px 8px;
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
@endsection
