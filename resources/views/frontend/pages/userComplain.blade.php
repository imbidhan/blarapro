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
                <li><a>/ Complain</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title"> Complain </h3>
                            <div class="customProfile">
                                <p class="depositMsgSize text-info mt-2 mb-3">If you have any complain fill free to message us</p>
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
                                        <form action="{{ route("user_complain_store") }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="username" style="display: block;text-align: left;">Username  <span class="text-danger">*</span></label>
                                                <input required id="username" class="form-control" type="text" name="username" value="{{ Auth::guard("web")->user()->username }}" readonly/>
                                            </div>

                                            <div class="form-group">
                                                <label for="phone" style="display: block;text-align: left;">Contact number <span class="text-danger">*</span></label>
                                                <input required id="phone" class="form-control" type="number" name="phone" placeholder="018XXXXXXXX"/>
                                                <p class="text-danger text-left">{{ $errors->has('phone') ? $errors->first('phone') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="image" style="display: block;text-align: left;">Complain Image</label>
                                                <input id="image" class="form-control" type="file" name="image" accept="image/*"/>
                                                <p class="text-danger text-left">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="message" style="display: block;text-align: left;">Message<span class="text-danger">*</span></label>
                                                <textarea required id="message" name="message" class="form-control" placeholder="Type your message."></textarea>
                                                <p class="text-danger text-left">{{ $errors->has('message') ? $errors->first('message') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="password" style="display: block;text-align: left;">Password<span class="text-danger">*</span></label>
                                                <input required id="password" class="form-control" type="password" name="password"  placeholder="Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="Submit Complain"/>
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
