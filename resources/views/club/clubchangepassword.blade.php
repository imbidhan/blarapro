@extends("frontend.frontendMaster")

@section("mainMenu")
    @include("frontend.partials.headerClub")
@endsection

@section("content")
    <!-- breadcrumb Start -->
    <section class="breadcrumbs-custom-wrap">
        <h1 class="text-center">
            <ul class="breadcroumbLink">
                <li><a href="{{ url("/club/home") }}">Home</a></li>
                <li><a>/ change password</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Change Password</h3>
                            <?php
                                $warning = Session::get('warning');
                                $success = Session::get('success');
                            ?>
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
                            <div class="customProfile">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <form action="{{ route("club_update_password") }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="oldPassword" style="display: block;text-align: left;">Old Password <span class="text-danger">*</span></label>
                                                <input required class="form-control" type="password" name="oldPassword" placeholder="Old Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('oldPassword') ? $errors->first('oldPassword') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="newPassword" style="display: block;text-align: left;">New Password <span class="text-danger">*</span></label>
                                                <input required class="form-control" type="password" id="newPassword" name="password" placeholder="New Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword" style="display: block;text-align: left;">Confirm Password <span class="text-danger">*</span></label>
                                                <input required class="form-control" id="confirmPassword" type="password" name="password_confirmation" placeholder="Confirm Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="Change Password"/>
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
        $('#myAccount').addClass('active');
    </script>

@endsection

