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
                <li><a>/ sponsor</a></li>
            </ul>
        </h1>
    </section>
    <section class="login-section" style="padding:20px 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-block text-center">
                        <div style="padding:0px 20px;">
                            <h3 class="title">Get Sponsor</h3>

                            <div class="customProfile">
                                <table id="example" class="table table-sm table-striped table-bordered table-responsive-lg table-responsive-md table-responsive-sm" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th >From User</th>
                                        <th >Sponsor Bonus</th>
                                        <th >Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($getSponsors->count() > 0)
                                        @foreach($getSponsors as $getSponsor)
                                            <tr>
                                                <td>{{ ucwords($getSponsor->user->username) }}</td>
                                                <td>{{ $getSponsor->sponsorGet }}</td>
                                                <td>
                                                    @if($getSponsor->created_at)
                                                        <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $getSponsor->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i: A');
                                                        ?>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3"><h3 class="text-warning">No sponsor yet</h3></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            {!! $getSponsors->links() !!}
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
    </script>

@endsection
