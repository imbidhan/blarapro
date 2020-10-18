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
                <li><a>/ change club</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Change Club</h3>
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
                                        <form action="{{ route("update_club",["username"=>$user->username]) }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label for="club_id" style="display: block;text-align: left;">Club <span class="text-danger">*</span></label>
                                                <select id="club_id" name="club_id" class="form-control" tabindex="-1" style="height:50px">
                                                    @if(!empty($clubs))
                                                        @foreach($clubs as $club)
                                                            <option @if ($user->club_id == $club->id) selected="selected" @endif value="{{ $club->id }}">{{ ucwords($club->clubName) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <p class="text-danger text-left">{{ $errors->has('club_id') ? $errors->first('club_id') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" style="display: block;text-align: left;">Password <span class="text-danger">*</span></label>
                                                <input required class="form-control" type="password" name="password" placeholder="Password"/>
                                                <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="Change Club"/>
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

