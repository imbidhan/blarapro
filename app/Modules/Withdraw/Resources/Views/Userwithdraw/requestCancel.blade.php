@extends('backend.backendMaster')
@section('title', 'Request Withdraw')
@section('page_title', 'Request Withdraw')
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
                                                <th scope="col">Username</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Coin</th>
                                                <th scope="col">Payment Type</th>
                                                <th scope="col">Ref</th>
                                                <th scope="col">Withdraw Date</th>
                                                <th scope="col">Cancel Date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">To</th>
                                                <th scope="col">Coin</th>
                                                <th scope="col">Payment Type</th>
                                                <th scope="col">Ref</th>
                                                <th scope="col">Withdraw Date</th>
                                                <th scope="col">Cancel Date</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            @if($userWithdrawHistories->count() > 0)
                                                @foreach($userWithdrawHistories as $userWithdrawHistoy)
                                                    <tr>
                                                        <td scope="row">{{ $userWithdrawHistoy->user->username }}</td>
                                                        <td>{{ $userWithdrawHistoy->withdrawNumber }}</td>
                                                        <td>{{ $userWithdrawHistoy->withdrawAmount }}</td>
                                                        <td>{{ ucwords($userWithdrawHistoy->withdrawPaymentType) }}</td>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            @if($userWithdrawHistoy->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userWithdrawHistoy->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($userWithdrawHistoy->withdrawReturnDateTime)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userWithdrawHistoy->withdrawReturnDateTime, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($userWithdrawHistoy->status == 2)
                                                                <span class="badge badge-danger">Withdraw Cancel</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
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
        $('#withdrawManage').addClass('active open');
        $('#withdrawUserRequestCancel').addClass('active');
    </script>
@endsection
