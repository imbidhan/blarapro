@extends('backend.backendMaster')
@section('title', 'Search Result')
@section('page_title', 'Search Result')
@section('page_content')
    <!-- Page -->
    <div class="page">

        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">@yield('page_title')</li>
            </ol>
        </div>

        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if(!empty($userRegDeps))
                    <div class="panel panel-bordered panel-dark border border-dark">

                        <div class="panel-heading">
                            <h3 class="panel-title">Deposit Get Money</h3>
                        </div>

                        <div class="p-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="p-5">
                                        <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                            <thead class="font-weight-bold">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User</th>
                                                    <th>Pay Type</th>
                                                    <th>Phone From</th>
                                                    <th>Phone To</th>
                                                    <th>Dep.Amount</th>
                                                    <th>Dep.Type</th>
                                                    <th>Accepted</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php($i=1)
                                            @foreach($userRegDeps as $userRegDep)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $userRegDep->username }}</td>
                                                    <td>{{ $userRegDep->paymentMethodType }}</td>
                                                    <td>{{ $userRegDep->phoneForm }}</td>
                                                    <td>{{ $userRegDep->phoneTo }}</td>
                                                    <td>{{ $userRegDep->depositAmount }}</td>
                                                    <td>{{ $userRegDep->depositType }}</td>
                                                    <td>{{ $userRegDep->acceptedBy }}</td>
                                                    <td>{{ $userRegDep->updated_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($userWithdraws))
                    <div class="panel panel-bordered panel-dark border border-dark">

                        <div class="panel-heading">
                            <h3 class="panel-title text-warning">User Withdraw</h3>
                        </div>

                        <div class="p-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="p-5">
                                        <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                            <thead class="font-weight-bold">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User</th>
                                                    <th>Withdraw Amount</th>
                                                    <th>Withdraw Number</th>
                                                    <th>Payment Type</th>
                                                    <th>Accepted</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php($i=1)
                                                @foreach($userWithdraws as $userWithdraw)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $userWithdraw->username }}</td>
                                                        <td>{{ $userWithdraw->withdrawAmount }}</td>
                                                        <td>{{ $userWithdraw->withdrawNumber }}</td>
                                                        <td>{{ $userWithdraw->withdrawPaymentType }}</td>
                                                        <td>{{ $userWithdraw->acceptedBy }}</td>
                                                        <td>{{ $userWithdraw->updated_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if(!empty($userCTCDeps))
                        <div class="panel panel-bordered panel-dark border border-dark">

                            <div class="panel-heading">
                                <h3 class="panel-title font-weight-bold">Deposit Coin to Coin</h3>
                            </div>

                            <div class="p-2">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="p-5">
                                            <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                                <thead class="font-weight-bold">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>User</th>
                                                    <th>Pay Type</th>
                                                    <th>Phone From</th>
                                                    <th>Phone To</th>
                                                    <th>Dep.Amount</th>
                                                    <th>Dep.Type</th>
                                                    <th>Accepted</th>
                                                    <th>Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i=1)
                                                @foreach($userCTCDeps as $userCTCDep)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $userCTCDep->username }}</td>
                                                        <td>{{ $userCTCDep->paymentMethodType }}</td>
                                                        <td>{{ $userCTCDep->phoneForm }}</td>
                                                        <td>{{ $userCTCDep->phoneTo }}</td>
                                                        <td>{{ $userCTCDep->depositAmount }}</td>
                                                        <td>{{ $userCTCDep->depositType }}</td>
                                                        <td>{{ $userCTCDep->acceptedBy }}</td>
                                                        <td>{{ $userCTCDep->updated_at }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($clubWithdraws))
                            <div class="panel panel-bordered panel-dark border border-dark">

                                <div class="panel-heading">
                                    <h3 class="panel-title text-warning">Club Withdraw</h3>
                                </div>

                                <div class="p-2">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="p-5">
                                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                                    <thead class="font-weight-bold">
                                                    <tr>
                                                        <th>SL</th>
                                                        <th>Club</th>
                                                        <th>Withdraw Amount</th>
                                                        <th>Payment Type</th>
                                                        <th>Accepted</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php($i=1)
                                                    @foreach($clubWithdraws as $clubWithdraw)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>{{ $clubWithdraw->username }}</td>
                                                            <td>{{ $clubWithdraw->withdrawAmount }}</td>
                                                            <td>{{ $clubWithdraw->withdrawType }}</td>
                                                            <td>{{ $clubWithdraw->acceptedBy }}</td>
                                                            <td>{{ $clubWithdraw->updated_at }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    @if(isset($userRegDepTotal) || isset($userCTCDepTotal) || isset($userWithdrawTotal) || isset($clubWithdrawTotal))
                        <div class="bg-dark p-2">

                            <a style="margin-right:50px;" href="{{ route("total_system_search") }}" class="btn btn-sm btn-danger">Back</a>
                            @if(!empty($userRegDepTotal))
                                <span class="font-weight-bold text-info">Deposit = {{ $userRegDepTotal }}</span> &nbsp;&nbsp;&nbsp;&nbsp;
                            @endif

                            @if(!empty($userWithdrawTotal))
                                <span class="font-weight-bold text-danger">Withdraw = {{ $userWithdrawTotal }}</span> &nbsp;&nbsp;&nbsp;&nbsp;
                            @endif

                            @if(!empty($userCTCDepTotal))
                                <span class="font-weight-bold text-warning">Coin to Coin = {{ $userCTCDepTotal }}</span> &nbsp;&nbsp;&nbsp;&nbsp;
                            @endif

                            @if(!empty($clubWithdrawTotal))
                                <span class="font-weight-bold text-danger">Club Withdraw = {{ $clubWithdrawTotal }}</span> &nbsp;&nbsp;&nbsp;&nbsp;
                            @endif
                        </div>

                    @else
                        <div class="bg-dark p-2">
                            <a style="margin-right:450px" href="{{ route("total_system_search") }}" class="btn btn-sm btn-danger">Back</a> <b> Not Found</b>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
    <!-- End Page -->
@endsection

@section('page_styles')
    @include('backend.partials._styles')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    <script type="text/javascript">
        $('#depositMasterManage').addClass('active open');
        $('#totalSearch').addClass('active');
    </script>
@endsection
