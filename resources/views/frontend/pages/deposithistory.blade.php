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
                <li><a>/ deposit history</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">

        <div class="login-block text-center">
            <h3 class="title">Deposit History</h3>
            <?php $warning = Session::get('warning') ?>
            <?php $success = Session::get('success') ?>
            @if(isset($warning))
                <div class="col-md-6 offset-md-3 alert alert-danger alert-dismissible fade show">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $warning }}
                </div>
            @endif

            @if(isset($success))
                <div class="col-md-6 offset-md-3 alert alert-success alert-dismissible fade show">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ $success }}
                </div>
            @endif
            <div class="customProfile">
                <table id="example" class="table table-sm table-responsive-lg table-responsive-md table-responsive-sm table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th >Username</th>
                        <th >Amount</th>
                        <th >From</th>
                        <th >To</th>
                        <th >Status</th>
                        <th >Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($userDeposits->count() > 0)
                        @foreach($userDeposits as $userDeposit)
                            <tr>
                                <td>{{ $userDeposit->userCreated->username }}</td>
                                <td>{{ $userDeposit->depositAmount }}</td>
                                <td>{{ $userDeposit->phoneForm }}</td>
                                <td>{{ $userDeposit->phoneTo }}</td>
                                <td>
                                    @if($userDeposit->status == 0)
                                        <span class="badge badge-pill badge-warning p-2"> Pending </span>
                                    @endif
                                    @if($userDeposit->status == 1)
                                        <span class="badge badge-pill badge-success p-2"> Accepted </span>
                                    @endif
                                    @if($userDeposit->status == 2)
                                        <span class="badge badge-pill badge-danger p-2"> Unpaid </span>
                                    @endif
                                </td>
                                <td>
                                    @if($userDeposit->created_at)
                                        <?php
                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userDeposit->created_at, new DateTimeZone("UTC"));
                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                        ?>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr><td colspan="6"> <h3 class="text-warning">Not Deposit Yet</h3> </td></tr>
                    @endif
                    </tbody>
                </table>

            </div>
            {!! $userDeposits->links() !!}
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
