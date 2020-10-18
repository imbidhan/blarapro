@extends('backend.backendMaster')
@section('title', 'Configuration edit')
@section('page_title', 'Configuration edit')
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
                                        <form action="{{ route('config_update',["id"=>$config->id]) }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Site Notice
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <textarea required rows="3" name="siteNotice" class="form-control">{{ $config->siteNotice }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Deposit Message
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <textarea required rows="2" name="depositMsg" class="form-control">{{ $config->depositMsg }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Bet Minimum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="betMinimum" value="{{ $config->betMinimum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Bet Maximum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="betMaximum" value="{{ $config->betMaximum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Deposit Minimum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="depositMinimum" value="{{ $config->depositMinimum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Deposit Maximum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="depositMaximum" value="{{ $config->depositMaximum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Coin Transfer Minimum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="coinTransferMinimum" value="{{ $config->coinTransferMinimum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Coin Transfer Maximum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="coinTransferMaximum" value="{{ $config->coinTransferMaximum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                     User Withdraw Minimum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="userWithdrawMinimum" value="{{ $config->userWithdrawMinimum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                     User Withdraw Maximum
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="userWithdrawMaximum" value="{{ $config->userWithdrawMaximum }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                     Club Rate
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="clubRate" value="{{ $config->clubRate }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Sponsor Rate
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="sponsorRate" value="{{ $config->sponsorRate }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Partial One
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="partialOne" value="{{ $config->partialOne }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Partial Two
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <input required type="text" class="form-control" name="partialTwo" value="{{ $config->partialTwo }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Coin Transfer Status
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="coinTransferStatus" required>
                                                                <option value="">Select coin transfer status</option>
                                                                <option value="1" @if($config->coinTransferStatus == 1) selected="selected" @endif>On</option>
                                                                <option value="0" @if($config->coinTransferStatus == 0) selected="selected" @endif>Off</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    User bet OnOFF
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="betOnOff" required>
                                                                <option value="">Select bet status status</option>
                                                                <option value="1" @if($config->betOnOff == 1) selected="selected" @endif>On</option>
                                                                <option value="0" @if($config->betOnOff == 0) selected="selected" @endif>Off</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    User withdraw status
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="userWithdrawStatus" required>
                                                                <option value="">Select club withdraw status</option>
                                                                <option value="1" @if($config->userWithdrawStatus == 1) selected="selected" @endif>On</option>
                                                                <option value="0" @if($config->userWithdrawStatus == 0) selected="selected" @endif>Off</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-lg">
                                                <div class="col-xl-6 form-horizontal">
                                                    <div class="form-group">
                                                        <div class="input-group input-group-icon">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">
                                                                    Club withdraw status
                                                                    <span class="required text-danger"> *</span>
                                                                </div>
                                                            </div>
                                                            <select class="form-control" name="clubWithdrawStatus" required>
                                                                <option value="">Select club withdraw status</option>
                                                                <option value="1" @if($config->clubWithdrawStatus == 1) selected="selected" @endif>On</option>
                                                                <option value="0" @if($config->clubWithdrawStatus == 0) selected="selected" @endif>Off</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Update Config</button>
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
    @include('backend.partials._formvalidation_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._formvalidation_script')
    <script src="{{ asset('/validation/configValidation.js') }}"></script>
    <script type="text/javascript">
        $('#configManage').addClass('active open');
        $('#configManageChildLi').addClass('active');
    </script>
@endsection
