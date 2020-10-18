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
                <li><a>/ club follower</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">My follower</h3>

                            <div class="customProfile">
                                <table id="example" class="table table-striped table-bordered table-sm table-responsive-lg table-responsive-md table-responsive-sm" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Join Date</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($followers))
                                        @foreach($followers as $follower)
                                            <tr>
                                                <td>{{ $follower->username }}</td>
                                                <td>{{ $follower->phone }}</td>
                                                <td>
                                                    @if($follower->created_at)
                                                        <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $follower->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                        ?>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($follower->status == 1)
                                                        <span class="badge badge-pill badge-success">Active</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {!! $followers->links() !!}
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
