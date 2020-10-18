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
                <li><a>/ coin transfer</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title"> Coin Transfer </h3>
                            <div class="customProfile">
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
                                        <form action="{{ route("store_coin_transfer") }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="username" style="display: block;text-align: left;">Username<span class="text-danger">*</span></label>
                                                <input required autofocus id="username" class="form-control" type="text" name="username" placeholder="Username" value="{{ old("username") }}" {{ $errors->has('username') ? 'autofocus' : ' ' }}/>
                                                <p class="text-danger text-left">{{ $errors->has('username') ? $errors->first('username') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="transferAmount" style="display: block;text-align: left;">Number of Coins ({{$config->coinTransferMinimum}}-{{$config->coinTransferMaximum}})<span class="text-danger">*</span></label>
                                                <input required id="transferAmount" class="form-control" type="number" min="0" name="transferAmount" placeholder="({{$config->coinTransferMinimum}}-{{$config->coinTransferMaximum}})" value="{{ old("transferAmount") }}" {{ $errors->has('transferAmount') ? 'autofocus' : ' ' }}/>
                                                <p class="text-danger text-left">{{ $errors->has('transferAmount') ? $errors->first('transferAmount') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="password" style="display: block;text-align: left;">Password<span class="text-danger">*</span></label>
                                                <input required id="password" class="form-control" type="password" name="password"  placeholder="Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <input id="submit" type="submit" class="btn btn-info" value="Transfer"/>
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
