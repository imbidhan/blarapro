@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.header")
@endsection

@section("content")
    <!-- breadcrumb Start -->
    <section class="breadcrumbs-custom-wrap">
        <h1 class="text-center">
            <ul class="breadcroumbLink">
                <li><a href="{{ url("/") }}">Home</a></li>
                <li><a>/ bet history</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">

        <div class="login-block text-center">
            <h3 class="title">Bet History </h3>
                <div class="customProfile">
                    <table id="example" class="table table-sm table-responsive-lg table-responsive-md table-responsive-sm table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th>Team</th>
                        <th>Bet Title</th>
                        <th>Bet On</th>
                        <th>Bet Rate</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($betHistories->count() > 0)
                        @foreach($betHistories as $betHistory)
                            <tr>
                                <td>{{ucwords($betHistory->match->teamOne->teamName)}} vs {{ucwords($betHistory->match->teamTwo->teamName)}}</td>
                                <td>{{ ucwords($betHistory->betoption->betOptionName) }}</td>
                                <td>{{ $betHistory->betdetail->betName }}</td>
                                <td>{{ $betHistory->betRate }}</td>
                                <td>{{ intval($betHistory->betAmount) }}</td>
                                <td>
                                    @if($betHistory->winLost == 'match upcoming')
                                        <span class="badge badge-primary">{{ ucwords($betHistory->winLost) }}</span>
                                    @elseif($betHistory->winLost == 'match live')
                                        <span class="badge badge-primary">{{ ucwords($betHistory->winLost) }}</span>
                                    @elseif($betHistory->winLost == 'win')
                                        <span class="badge badge-success">{{ ucwords($betHistory->winLost) }}</span>
                                    @elseif($betHistory->winLost == 'lost')
                                        <span class="badge badge-warning">{{ ucwords($betHistory->winLost) }}</span>
                                    @elseif($betHistory->winLost == 'bet return')
                                        <span class="badge badge-danger">{{ $betHistory->winLost }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ ucwords($betHistory->winLost) }} % </span>
                                    @endif
                                </td>
                                <td>
                                    @if($betHistory->created_at)
                                        <?php
                                            $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $betHistory->created_at, new DateTimeZone("UTC"));
                                            echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                        ?>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8"><h3 class="text-warning">No Bet History</h3></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                </div>
                {{ $betHistories->links() }}
        </div>

    </section>
@endsection

@section("main-footer")
    @include("frontend.partials.footer")
@endsection

@section("main-script")
    @include("frontend.partials.scriptFiles")
@endsection

@section("scriptExtra")

    <script type="text/javascript">
        $('#myAccount').addClass('active');
    </script>

@endsection
