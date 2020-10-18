@extends('backend.backendMaster')
@section('title', 'Search')
@section('page_title', 'Search')
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
                    <div class="panel panel-bordered panel-dark border border-dark">
                        <div class="panel-heading">
                            <h3 class="panel-title">@yield('page_title')</h3>
                        </div>
                        <div class="p-2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <form method="get" action="{{ route("total_deposit_withdraw") }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-xl-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Action Type
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="actionType">
                                                                <option class="font-size-16 font-weight-bold" value="both">Both</option>
                                                                <option class="font-size-16 font-weight-bold" value="deposit">Deposit</option>
                                                                <option class="font-size-16 font-weight-bold" value="withdraw">Withdraw</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Day
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="day">
                                                                <option class="font-size-16 font-weight-bold" value="">Select</option>
                                                                <option class="font-size-16 font-weight-bold" value="01">01</option>
                                                                <option class="font-size-16 font-weight-bold" value="02">02</option>
                                                                <option class="font-size-16 font-weight-bold" value="03">03</option>
                                                                <option class="font-size-16 font-weight-bold" value="04">04</option>
                                                                <option class="font-size-16 font-weight-bold" value="05">05</option>
                                                                <option class="font-size-16 font-weight-bold" value="06">06</option>
                                                                <option class="font-size-16 font-weight-bold" value="07">07</option>
                                                                <option class="font-size-16 font-weight-bold" value="08">08</option>
                                                                <option class="font-size-16 font-weight-bold" value="09">09</option>
                                                                <option class="font-size-16 font-weight-bold" value="10">10</option>
                                                                <option class="font-size-16 font-weight-bold" value="11">11</option>
                                                                <option class="font-size-16 font-weight-bold" value="12">12</option>
                                                                <option class="font-size-16 font-weight-bold" value="13">13</option>
                                                                <option class="font-size-16 font-weight-bold" value="14">14</option>
                                                                <option class="font-size-16 font-weight-bold" value="15">15</option>
                                                                <option class="font-size-16 font-weight-bold" value="16">16</option>
                                                                <option class="font-size-16 font-weight-bold" value="17">17</option>
                                                                <option class="font-size-16 font-weight-bold" value="18">18</option>
                                                                <option class="font-size-16 font-weight-bold" value="19">19</option>
                                                                <option class="font-size-16 font-weight-bold" value="20">20</option>
                                                                <option class="font-size-16 font-weight-bold" value="21">21</option>
                                                                <option class="font-size-16 font-weight-bold" value="22">22</option>
                                                                <option class="font-size-16 font-weight-bold" value="23">23</option>
                                                                <option class="font-size-16 font-weight-bold" value="24">24</option>
                                                                <option class="font-size-16 font-weight-bold" value="25">25</option>
                                                                <option class="font-size-16 font-weight-bold" value="26">26</option>
                                                                <option class="font-size-16 font-weight-bold" value="27">27</option>
                                                                <option class="font-size-16 font-weight-bold" value="28">28</option>
                                                                <option class="font-size-16 font-weight-bold" value="29">29</option>
                                                                <option class="font-size-16 font-weight-bold" value="30">30</option>
                                                                <option class="font-size-16 font-weight-bold" value="31">31</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Month
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="month">
                                                                <option class="font-size-16 font-weight-bold" value="01">January</option>
                                                                <option class="font-size-16 font-weight-bold" value="02">February</option>
                                                                <option class="font-size-16 font-weight-bold" value="03">March</option>
                                                                <option class="font-size-16 font-weight-bold" value="04">April</option>
                                                                <option class="font-size-16 font-weight-bold" value="05">May</option>
                                                                <option class="font-size-16 font-weight-bold" value="06">June</option>
                                                                <option class="font-size-16 font-weight-bold" value="07">July</option>
                                                                <option class="font-size-16 font-weight-bold" value="08">August</option>
                                                                <option class="font-size-16 font-weight-bold" value="09">September</option>
                                                                <option class="font-size-16 font-weight-bold" value="10">October</option>
                                                                <option class="font-size-16 font-weight-bold" value="11">November</option>
                                                                <option class="font-size-16 font-weight-bold" value="12">December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Year
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="year">
                                                                <option class="font-size-16 font-weight-bold" value="2020">2020</option>
                                                                <option class="font-size-16 font-weight-bold" value="2021">2021</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <input class="form-control btn btn-block btn-secondary" type="submit" name="search" value="Search"/>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
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
@endsection

@section('page_scripts')
    @include('backend.partials._scripts')
    <script type="text/javascript">
        $('#depositMasterManage').addClass('active open');
        $('#totalSearch').addClass('active');
    </script>
@endsection
