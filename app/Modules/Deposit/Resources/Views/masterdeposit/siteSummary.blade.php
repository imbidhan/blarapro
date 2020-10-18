@extends('backend.backendMaster')
@section('title', 'Site Summary')
@section('page_title', 'Site Summary')
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
                                        <table class="table table-hover dataTable table-striped w-full"
                                               id="exampleTableTools">
                                            <thead>
                                            <tr>
                                                <th>Today</th>
                                                <th>SiteDeposit</th>
                                                <th>RestDeposit</th>
                                                <th>RegularDeposit</th>
                                                <th>CoinDeposit</th>
                                                <th>ClubProfit</th>
                                                <th>SponsorProfit</th>
                                                <th>UserProfit</th>
                                                <th>SiteProfit</th>
                                                <th>PartialProfit</th>
                                                <th>NetProfit</th>
                                                <th>UserBalance</th>
                                                <th>UnpublishedAmount</th>
                                                <th>UserWithdraw</th>
                                                <th>ClubWithdrawSendMoney</th>
                                                <th>ClubWithdrawSendCoin</th>
                                                <th>Rest Club Amount</th>
                                                <th>SiteWithdraw</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <span class="badge badge-pill badge-success">
                                                            <?php
                                                            date_default_timezone_set("Asia/Dhaka");
                                                            echo date("d-M-Y h:i A");
                                                            ?>
                                                        </span>
                                                    </td>
                                                    <td>{{ $siteDeposit }}</td>
                                                    <td>{{ ($siteDeposit - (($userRegularDeposit + $userSpecialDeposit + $clubProfit + $sponsorProfit + $userProfit))) }}</td>
                                                    <td>{{ $userRegularDeposit }}</td>
                                                    <td>{{ $userSpecialDeposit }}</td>
                                                    <td>{{ $clubProfit }}</td>
                                                    <td>{{ $sponsorProfit }}</td>
                                                    <td>{{ $userProfit }}</td>
                                                    <td>{{ $siteProfit }}</td>
                                                    <td>{{ $partialProfit }}</td>
                                                    <td>{{ ($siteProfit - ((($clubProfit + $sponsorProfit + $userProfit)))) }}</td>
                                                    <td>{{ $userTotalBalance }}</td>
                                                    <td>{{ $betPlaceBalance }}</td>
                                                    <td>{{ $userWithdraws }}</td>
                                                    <td>{{ $clubSendMoney }}</td>
                                                    <td>{{ $clubSendCoin }}</td>
                                                    <td>{{ ($clubProfit - ( $clubSendMoney + $clubSendCoin)) }}</td>
                                                    <td>{{ $siteWithdraw }}</td>
                                                </tr>

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
    <style>
        .md-fab-wrapper {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1004;
            -webkit-transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
            transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
        }

        .md-fab.md-fab-accent {
            background: #17a2b8;
        }

        .md-fab {
            box-sizing: border-box;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            color: #727272;
            display: block;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            -webkit-transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            border: none;
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        .md-fab.md-fab-accent>i {
            color: #fff;
        }

        .md-fab>i {
            font-size: 20px;
            line-height: 66px;
            height: inherit;
            width: inherit;
            position: absolute;
            left: 0;
            top: 0;
            color: #727272;
        }
    </style>
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#depositMasterManage').addClass('active open');
        $('#siteSummaryLi').addClass('active');
    </script>
@endsection
