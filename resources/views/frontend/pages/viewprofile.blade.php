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
                <li><a>/ view profile</a></li>
            </ul>
        </h1>
    </section>

    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            @if(!empty($user))
                            <h3 class="title">My Profile </h3>
                            <div class="customProfile">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Username</td>
                                            <td> {{ ucwords($user->username) }} </td>
                                        </tr>
                                        <tr>
                                            <td>Club</td>
                                            <td> {{ ucwords($user->club->clubName) }} </td>
                                        </tr>
                                        <tr>
                                            <td>Sponsor</td>
                                            <td>
                                                @if($user->sponsorName != null)
                                                    {{ ucwords($user->sponsorName) }}
                                                @else
                                                    Not Given
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Join Date</td>
                                            <td>
                                                @if($user->created_at)
                                                    <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $user->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                    ?>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>
                                                @if($user->status == 1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-md btn-primary" href="{{ route("edit_profile") }}">Edit Profile</a>
                            </div>
                            @endif
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

