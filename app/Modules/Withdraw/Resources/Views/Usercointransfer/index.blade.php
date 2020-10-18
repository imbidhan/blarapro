@extends('backend.backendMaster')
@section('title', 'Coin transfer record')
@section('page_title', 'Coin transfer record')
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
                    <div class="panel panel-bordered panel-info border border-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">@yield('page_title')</h3>
                        </div>
                        <div class="p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <table class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
                                            <thead>
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">From Club</th>
                                                <th scope="col">From Username</th>
                                                <th scope="col">From T.ReceiveAmount</th>
                                                <th scope="col">From T.TransferAmount</th>
                                                <th scope="col">To Club</th>
                                                <th scope="col">To Username</th>
                                                <th scope="col">To T.ReceiveAmount</th>
                                                <th scope="col">To T.TransferAmount</th>
                                                <th scope="col">Amount</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if($userCoinTransfers->count() > 0)
                                                @foreach($userCoinTransfers as $userCoinTransfer)
                                                    <tr>
                                                        <td>
                                                            @if($userCoinTransfer->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userCoinTransfer->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td scope="row">{{ $userCoinTransfer->fromClub }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->fromUser }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->fromUserReceiveAmount }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->fromUserTransferAmount }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->toClub }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->toUser }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->toUserReceiveAmount }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->toUserTransferAmount }}</td>
                                                        <td scope="row">{{ $userCoinTransfer->transferAmount }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                        {{ $userCoinTransfers->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#coinTransferManage').addClass('active open');
        $('#coinTransferManageLi').addClass('active');
    </script>
@endsection
