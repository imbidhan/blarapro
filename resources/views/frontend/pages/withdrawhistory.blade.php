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
                <li><a>/ withdraw history</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">

        <div class="login-block text-center">
            <h3 class="title">Withdraw History </h3>
            <?php $success = Session::get('success') ?>

            @if(isset($success))
                <div class="col-md-6 offset-md-3 alert alert-success alert-dismissible fade show">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $success }}
                </div>
            @endif

            <div class="customProfile">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">To</th>
                            <th scope="col">Method</th>
                            <th scope="col">Coin</th>
                            <th scope="col">Ref</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($userWithdrawHistories->count() > 0)
                        @foreach($userWithdrawHistories as $userWithdrawHistoy)
                            <tr>

                                <td>{{ $userWithdrawHistoy->withdrawNumber }}</td>
                                <td>{{ $userWithdrawHistoy->withdrawPaymentType }}</td>
                                <td>{{ intval($userWithdrawHistoy->withdrawAmount) }}</td>
                                <td>
                                    {{ $userWithdrawHistoy->reference }}
                                </td>
                                <td>
                                    @if($userWithdrawHistoy->created_at)
                                        <?php
                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userWithdrawHistoy->created_at, new DateTimeZone("UTC"));
                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y H:i:A');
                                        ?>
                                    @endif
                                </td>
                                <td>
                                    @if($userWithdrawHistoy->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        <a onclick="return confirm('Are you sure cancel withdraw?');" class="btn btn-sm btn-danger" href="{{ route("user_withdraw_cancel",["id"=>$userWithdrawHistoy->id]) }}">Refund</a>
                                    @endif
                                    @if($userWithdrawHistoy->status == 1)
                                        <span class="badge badge-success">Paid</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><h3 class="text-warning">No withdraw yet</h3></td>
                        </tr>
                    @endif
                </table>
            </div>
            {!! $userWithdrawHistories->links() !!}

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
