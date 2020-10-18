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
                                                <th scope="col">Coin</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Withdraw Type</th>
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th scope="col">Username</th>
                                                <th scope="col">Coin</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col" width="20%">Withdraw Type</th>
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            @if($clubWithdrawHistories->count() > 0)
                                                @foreach($clubWithdrawHistories as $clubWithdrawHistory)
                                                    <tr>
                                                        <td scope="row">{{ $clubWithdrawHistory->club->username }}</td>
                                                        <td>{{ $clubWithdrawHistory->withdrawAmount }}</td>
                                                        <td>
                                                            @if($clubWithdrawHistory->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $clubWithdrawHistory->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($clubWithdrawHistory->status == 0)
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route("club_new_withdraw_accept",["id"=>$clubWithdrawHistory->id]) }}" method="POST">
                                                                @csrf
                                                                <select class="form-control"  name="withdrawType">
                                                                    <option value="">Select withdraw type</option>
                                                                    <option value="sendmoney">Send Money</option>
                                                                    <option value="sendcoin">Send Coin</option>
                                                                </select>
                                                                <input onclick="return confirm('Are you sure withdraw type')" type="submit" value="Accept" class="btn btn-md btn-success mt-2 float-right"/>
                                                            </form>
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
        $('#withdrawClubRequest').addClass('active');
    </script>
@endsection
