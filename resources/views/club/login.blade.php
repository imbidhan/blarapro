@extends("frontend.frontendMaster")

@section("content")
    <style>
        textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        [contenteditable].form-control:focus {
            box-shadow: inset 0 -1px 0 #ddd;
        }
    </style>
    <section class="login-section mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-block text-center">
                        <div class="login-block-inner">
                            <h3 class="title">Sign in your account </h3>
                            @error('username') <p class="text-danger text-left">{{ $errors->has('username') ? $errors->first('username') : ' ' }}</p> @enderror
                            @error('password') <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p> @enderror
                            @if(Session::get('error'))
                                <p class="text-danger text-left">{{ Session::get('error') }}</p>
                            @endif
                            <form class="cmn-form login-form" action="{{ route("club.login") }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group input-group-icon">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="width:50px; padding-left: 17px; background: #ff3952;">
                                                <span class="fa fa-user-o" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <input autofocus style="height: 50px; border: none;" type="text" class="form-control" name="username" placeholder="Username"  value="{{ old("username") }}" {{ $errors->has('username') ? 'autofocus' : ' ' }} >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-icon">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" style="width:50px; padding-left: 19px; background: #ff3952;">
                                                <span class="fa fa-lock" aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <input style="height: 50px" type="password" class="form-control" name="password" placeholder="Password"  value="{{ old("password") }}" {{ $errors->has('password') ? 'autofocus' : ' ' }}>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="submit-btn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
