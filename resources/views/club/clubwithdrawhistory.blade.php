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
                <li><a>/ withdraw history</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Withdraw History </h3>
                            <?php $success = Session::get('success') ?>
                            @if(isset($success))
                                <div class="col-md-6 offset-md-3 alert alert-success alert-dismissible fade show">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ $success }}
                                </div>
                            @endif
                            <div class="customProfile">
                                <table id="example2" class="table table-striped table-bordered table-sm table-responsive-lg table-responsive-md table-responsive-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Coin</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($clubWithdrawHistories->count() > 0)
                                        @foreach($clubWithdrawHistories as $clubWithdrawHistory)
                                            <tr>
                                                <td scope="row">{{ $clubWithdrawHistory->club->username }}</td>
                                                <td scope="row">{{ $clubWithdrawHistory->withdrawAmount }}</td>
                                                <td>
                                                    @if($clubWithdrawHistory->created_at)
                                                        <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $clubWithdrawHistory->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i: A');
                                                        ?>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($clubWithdrawHistory->status == 0)
                                                        <span class="badge badge-warning">Pending</span>
                                                        <a onclick="return confirm('Are you sure cancel withdraw?');" class="btn btn-sm btn-danger" href="{{ route("club_withdraw_cancel",["id"=>$clubWithdrawHistory->id]) }}">Refund</a>
                                                    @endif
                                                    @if($clubWithdrawHistory->status == 1)
                                                        <span class="badge badge-success">Paid</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4"><h3 class="text-warning">No withdraw history</h3></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            {!! $clubWithdrawHistories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
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
        $('#myWallet').addClass('active');
    </script>

@endsection
