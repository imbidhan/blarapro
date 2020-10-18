@extends('backend.backendMaster')
@section('title', 'Configuration')
@section('page_title', 'Configuration')
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
                                                    <th>Action</th>
                                                    <th>Bet Minimum</th>
                                                    <th>Bet Maximum</th>
                                                    <th>Deposit Minimum</th>
                                                    <th>Deposit Maximum</th>
                                                    <th>Coin Transfer Minimum</th>
                                                    <th>Coin Transfer Maximum</th>
                                                    <th>User Withdraw Minimum</th>
                                                    <th>User Withdraw Maximum</th>
                                                    <th>Club Rate</th>
                                                    <th>Sponsor Rate</th>
                                                    <th>Partial One Rate</th>
                                                    <th>Partial Two Rate</th>
                                                    <th>User bet status</th>
                                                    <th>Coin Transfer Status</th>
                                                    <th>User Withdraw Status</th>
                                                    <th>Club Withdraw Status</th>
                                                    <th>Updated At</th>
                                                    <th>Site Notice</th>
                                                    <th>Deposit Message</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Bet Minimum</th>
                                                    <th>Bet Maximum</th>
                                                    <th>Deposit Minimum</th>
                                                    <th>Deposit Maximum</th>
                                                    <th>Coin Transfer Minimum</th>
                                                    <th>Coin Transfer Maximum</th>
                                                    <th>User Withdraw Minimum</th>
                                                    <th>User Withdraw Maximum</th>
                                                    <th>Club Rate</th>
                                                    <th>Sponsor Rate</th>
                                                    <th>Partial One Rate</th>
                                                    <th>Partial Two Rate</th>
                                                    <th>User bet status</th>
                                                    <th>Coin Transfer Status</th>
                                                    <th>User Withdraw Status</th>
                                                    <th>Club Withdraw Status</th>
                                                    <th>Updated At</th>
                                                    <th>Site Notice</th>
                                                    <th>Deposit Message</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                @if($config)
                                                    <tr>
                                                        <td>
                                                            <a type="button" data-toggle="tooltip" data-placement="top"
                                                               data-trigger="hover" data-original-title="Edit"
                                                               class="btn btn-icon btn-xs btn-info btn-outline"
                                                               href="{{ route('config_edit',['id' => $config->id]) }}">
                                                                <i class="icon wb-edit" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        <td> {{ $config->betMinimum }} </td>
                                                        <td> {{ $config->betMaximum }} </td>
                                                        <td> {{ $config->depositMinimum }} </td>
                                                        <td> {{ $config->depositMaximum }} </td>
                                                        <td> {{ $config->coinTransferMinimum }} </td>
                                                        <td> {{ $config->coinTransferMaximum }} </td>
                                                        <td> {{ $config->userWithdrawMinimum }} </td>
                                                        <td> {{ $config->userWithdrawMaximum }} </td>
                                                        <td> {{ $config->clubRate }} </td>
                                                        <td> {{ $config->sponsorRate }} </td>
                                                        <td> {{ $config->partialOne }} </td>
                                                        <td> {{ $config->partialTwo }} </td>
                                                        <td>
                                                            @if($config->coinTransferStatus == 1)
                                                                <span class="badge badge-round badge-success">On</span>
                                                            @else
                                                                <span class="badge badge-round badge-danger">Off</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($config->betOnOff == 1)
                                                                <span class="badge badge-round badge-success">On</span>
                                                            @else
                                                                <span class="badge badge-round badge-danger">Off</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($config->userWithdrawStatus == 1)
                                                                <span class="badge badge-round badge-success">On</span>
                                                            @else
                                                                <span class="badge badge-round badge-danger">Off</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($config->clubWithdrawStatus == 1)
                                                                <span class="badge badge-round badge-success">On</span>
                                                             @else
                                                                <span class="badge badge-round badge-danger">Off</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($config->updated_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $config->updated_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td> {{ $config->siteNotice }} </td>
                                                        <td> {{ $config->depositMsg }} </td>
                                                    </tr>
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
        $('#configManage').addClass('active open');
        $('#configManageChildLi').addClass('active');
    </script>
@endsection
