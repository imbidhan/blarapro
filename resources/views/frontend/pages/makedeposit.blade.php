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
                <li><a>/ make deposit</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Make Deposit</h3>
                            <div class="customProfile">

                            <p class="depositMsgSize text-info mt-2 mb-3">{{$config->depositMsg}}</p>
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

                            <div class="row">
                                <div class="col-md-6 offset-md-3 col-sm-12">
                                <form action="{{ route("user_online_deposit") }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="paymentMethod" style="display: block;text-align: left;">Payment Method<span class="text-danger">*</span></label>
                                        <select required id="paymentMethod" name="paymentMethodType" class="form-control">
                                            <option value=""> Select method </option>
                                            <option @if (old('paymentMethodType') == 'bkash') selected="selected" @endif value="bkash">Bkash</option>
                                            <option @if (old('paymentMethodType') == 'nagad') selected="selected" @endif value="nagad" disabled>Nagad</option>
                                            <option @if (old('paymentMethodType') == 'skrill') selected="selected" @endif value="skrill" disabled>Skrill</option>
                                            <option @if (old('paymentMethodType') == 'paypal') selected="selected" @endif value="paypal" disabled>Paypal</option>
                                            <option @if (old('paymentMethodType') == 'stripe') selected="selected" @endif value="stripe" disabled>Stripe</option>
                                            <option @if (old('paymentMethodType') == 'neteller') selected="selected" @endif value="neteller" disabled>Neteller</option>
                                        </select>
                                        <p class="text-danger text-left">{{ $errors->has('paymentMethodType') ? $errors->first('paymentMethodType') : ' ' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="depositAmount" style="display: block;text-align: left;">Number of Coins ({{$config->depositMinimum}}-{{$config->depositMaximum}}) <span class="text-danger">*</span></label>
                                        <input required id="depositAmount" class="form-control" type="number" min="0" name="depositAmount" placeholder="({{$config->depositMinimum}}-{{$config->depositMaximum}})" value="{{ old("depositAmount") }}" {{ $errors->has('depositAmount') ? 'autofocus' : ' ' }}/>
                                        <p class="text-danger text-left">{{ $errors->has('depositAmount') ? $errors->first('depositAmount') : ' ' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneForm" style="display: block;text-align: left;">Phone From <span class="text-danger">*</span></label>
                                        <input required id="phoneForm" class="form-control" type="number" min="0" name="phoneForm" placeholder="Phone Form" value="{{ old("phoneForm") }}" {{ $errors->has('phoneForm') ? 'autofocus' : ' ' }}/>
                                        <p class="text-danger text-left">{{ $errors->has('phoneForm') ? $errors->first('phoneForm') : ' ' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="phoneTo" style="display: block;text-align: left;">Phone To <span class="text-danger"> * </span>  </label>
                                        <input required id="phoneTo" class="form-control" type="text" name="phoneTo" readonly value=""/>
                                        <p class="text-danger text-left">{{ $errors->has('phoneTo') ? $errors->first('phoneTo') : ' ' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" style="display: block;text-align: left;">Password<span class="text-danger">*</span></label>
                                        <input required id="password" class="form-control" type="password" name="password"  placeholder="Password"/>
                                        <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                    </div>

                                    <div class="form-group">
                                        <input id="submit" type="submit" class="btn btn-info" value="Request For Deposit"/>
                                    </div>

                                </form>
                            </div>
                        </div></div>
                        </div>
                    </div>
                </div>
            </div>
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

        $(window).on('load', function() {
            var base_url = window.location.origin;
            var redirect_url = base_url + '/deposit/number/refresh/';
            $.ajax({
                type: 'GET',
                url: redirect_url,
                success: function (data) {
                    $("#phoneTo").val("");
                    $("#phoneTo").val(data.bkashNumber);
                }
            });
        });

        $(document).ready(function(){

            setInterval(function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var base_url = window.location.origin;
                var redirect_url = base_url + '/deposit/number/refresh/';
                $.ajax({
                    type: 'GET',
                    url: redirect_url,
                    success: function (data) {
                        $("#phoneTo").val("");
                        $("#phoneTo").val(data.bkashNumber);
                    }
                });
            },6000);
        });

        $("#submit").on('click', function (event) {
            $("#submit").css("display", "none");
        });
        $('#submit').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    </script>
@endsection
