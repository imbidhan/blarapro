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
                <li><a>/ my profile</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Club Profile </h3>
                            <div class="customProfile">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Club Name</td>
                                        <td>{{ $club->clubName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td>{{ $club->username }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $club->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $club->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            @if($club->status == 1)
                                                <span class="badge badge-pill badge-success">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
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

