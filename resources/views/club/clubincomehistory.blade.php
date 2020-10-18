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
                <li><a>/ club history</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center" >
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Club History </h3>

                            <div class="customProfile">
                                <table id="example2" class="table table-striped table-bordered table-sm table-responsive-lg table-responsive-md table-responsive-sm" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th scope="col">Username</th>
                                        <th scope="col">Amount / Coin</th>
                                        <th scope="col">Date/Time</th>
                                        <th scope="col">Status</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($clubIncomes->count() > 0)
                                        @foreach($clubIncomes as $clubIncome)
                                            <tr>
                                                <td>
                                                    {{ $clubIncome->user->username }}
                                                </td>
                                                <td>
                                                    {{ ($clubIncome->betAmount/100) * $clubIncome->clubRate }}
                                                </td>
                                                <td>
                                                    @if($clubIncome->created_at)
                                                        <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $clubIncome->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:A');
                                                        ?>
                                                    @endif
                                                </td>
                                                <td>
                                                   <span class="badge badge-success">Paid</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="4"><h4 class="text-warning">Not Club History</h4></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            {!! $clubIncomes->links() !!}
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
