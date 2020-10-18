@extends('backend.backendMaster')
@section('title', 'User Deposit Request List')
@section('page_title', 'User Deposit Request List')
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
                                                    <th>Club</th>
                                                    <th>Username</th>
                                                    <th>Deposit amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Phone Form</th>
                                                    <th>Phone To</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($userDeposits) > 0)
                                                    @php($i=1)
                                                    @foreach ($userDeposits as $userDeposit)
                                                        <tr>
                                                            <td> {{ $userDeposit->userCreated->club->username }}</td>
                                                            <td> {{ $userDeposit->userCreated->username }}</td>
                                                            <td> {{ $userDeposit->depositAmount }}</td>
                                                            <td> {{ $userDeposit->paymentMethodType }}</td>
                                                            <td> <b class="badge badge-pill badge-dark p-2"> {{ $userDeposit->phoneForm }} </b></td>
                                                            <td> <b>{{ $userDeposit->phoneTo }}</b></td>
                                                            <td>
                                                                @if($userDeposit->status == 0)
                                                                    <span class="badge badge-pill badge-danger p-2"> Pending </span>
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
                                                            {{--<td><a class="btn btn-success btn-sm" href="{{ route("approve_user_online_deposit_request",["id" => $userDeposit->id]) }}">Accept</a></td>--}}
                                                            <td>
                                                                <form action="{{ route("approve_user_online_deposit_request",["id" => $userDeposit->id]) }}" method="POST">
                                                                    @csrf
                                                                    <select name="depositType" class="form-control">
                                                                        <option value="">Select Deposit Type</option>
                                                                        <option class="text-success font-weight-bold" value="getmoney">Get Money</option>
                                                                        <option class="text-warning font-weight-bold" value="cointocoin">Coin To Coin</option>
                                                                        <option class="text-danger font-weight-bold" value="unpaid">Unpaid</option>
                                                                    </select>
                                                                    <input onclick="return confirm('Are you sure about deposit type?')" class="mt-2 btn btn-primary btn-sm" type="submit" value="Change Status">
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
@endsection
