@extends('backend.backendMaster')
@section('title', 'Matches List')
@section('page_title', 'Matches List')
@section('page_content')
<!-- Page -->
<div class="page">

    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">@yield('page_title')</li>
        </ol>

    </div>


    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-success border border-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Cricket</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th width="10%">Action</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>DateTime</th>
                                            <th>Title</th>
                                            <th>Tournament</th>
                                            <th>TeamOne</th>
                                            <th>TeamTwo</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($circmatches) > 0)
                                        @foreach ($circmatches as $match)
                                        <tr>
                                            <td>
                                                @if($match->status == 0 || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <a type="button" data-toggle="tooltip" data-placement="top"
                                                        data-trigger="hover" data-original-title="Edit"
                                                        class="btn btn-xs btn-icon btn-info btn-outline"
                                                        href="{{ route('matches_edit',['id'=>$match->id])}}">
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Match Details"
                                                    class="btn btn-xs btn-icon btn-primary btn-outline"
                                                    href="{{ route('matches_detail',['id'=>$match->id])}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Unpublished list"
                                                    class="btn btn-xs btn-icon btn-danger"
                                                    href="{{ route('matches_unpublished_list',['id'=>$match->id])}}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                @if($match->status == 0)
                                                    <span class="badge badge-dark">Draft</span>
                                                @elseif($match->status == 1)
                                                    <span class="badge badge-primary">OnBet</span>
                                                @elseif($match->status == 2)
                                                    <span class="badge badge-success">Go Dashboard</span>
                                                @elseif($match->status == 3)
                                                    <span class="badge badge-success">Live</span>
                                                @elseif($match->status == 7)
                                                    <span class="badge badge-success">Hide form user</span>
                                                @endif
                                            </td>
                                            <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif
                                            <td>
                                                @if($match->matchDateTime)
                                                    {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                @endif
                                            </td>
                                            <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>

                                            <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif
                                            </td>
                                            <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif
                                            </td>
                                            <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif
                                            </td>
                                            <td>
                                                @if($match->created_at)
                                                <?php
                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC"));
                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                ?>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-primary border border-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Football</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th width="10%">Action</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>DateTime</th>
                                            <th>Title</th>
                                            <th>Tournament</th>
                                            <th>TeamOne</th>
                                            <th>TeamTwo</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($footmatches) > 0)
                                        @foreach ($footmatches as $match)
                                        <tr>
                                            <td>
                                                @if($match->status == 0 || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <a type="button" data-toggle="tooltip" data-placement="top"
                                                        data-trigger="hover" data-original-title="Edit"
                                                        class="btn btn-xs btn-icon btn-info btn-outline"
                                                        href="{{ route('matches_edit',['id'=>$match->id])}}">
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Match Details"
                                                    class="btn btn-xs btn-icon btn-primary btn-outline"
                                                    href="{{ route('matches_detail',['id'=>$match->id])}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Unpublished list"
                                                    class="btn btn-xs btn-icon btn-danger"
                                                    href="{{ route('matches_unpublished_list',['id'=>$match->id])}}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                @if($match->status == 0)
                                                    <span class="badge badge-dark">Draft</span>
                                                @elseif($match->status == 1)
                                                    <span class="badge badge-primary">OnBet</span>
                                                @elseif($match->status == 2)
                                                    <span class="badge badge-success">Go Dashboard</span>
                                                @elseif($match->status == 3)
                                                    <span class="badge badge-success">Live</span>
                                                @elseif($match->status == 7)
                                                    <span class="badge badge-success">Hide form user</span>
                                                @endif
                                            </td>
                                            <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif
                                            <td>
                                                @if($match->matchDateTime)
                                                    {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                @endif
                                            </td>
                                            <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>
                                            <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif
                                            </td>
                                            <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif
                                            </td>
                                            <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif
                                            </td>
                                            <td>
                                                @if($match->created_at)
                                                <?php
                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC"));
                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                ?>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-danger border border-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basketball</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th width="10%">Action</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>DateTime</th>
                                            <th>Title</th>
                                            <th>Tournament</th>
                                            <th>TeamOne</th>
                                            <th>TeamTwo</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($baskmatches) > 0)
                                        @foreach ($baskmatches as $match)
                                        <tr>
                                            <td>
                                                @if($match->status == 0 || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <a type="button" data-toggle="tooltip" data-placement="top"
                                                        data-trigger="hover" data-original-title="Edit"
                                                        class="btn btn-xs btn-icon btn-info btn-outline"
                                                        href="{{ route('matches_edit',['id'=>$match->id])}}">
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Match Details"
                                                    class="btn btn-xs btn-icon btn-primary btn-outline"
                                                    href="{{ route('matches_detail',['id'=>$match->id])}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Unpublished list"
                                                    class="btn btn-xs btn-icon btn-danger"
                                                    href="{{ route('matches_unpublished_list',['id'=>$match->id])}}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                @if($match->status == 0)
                                                    <span class="badge badge-dark">Draft</span>
                                                @elseif($match->status == 1)
                                                    <span class="badge badge-primary">OnBet</span>
                                                @elseif($match->status == 2)
                                                    <span class="badge badge-success">Go Dashboard</span>
                                                @elseif($match->status == 3)
                                                    <span class="badge badge-success">Live</span>
                                                @elseif($match->status == 7)
                                                    <span class="badge badge-success">Hide form user</span>
                                                @endif
                                            </td>
                                            <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif
                                            <td>
                                                @if($match->matchDateTime)
                                                    {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                @endif
                                            </td>
                                            <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>
                                            <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif
                                            </td>
                                            <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif
                                            </td>
                                            <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif
                                            </td>
                                            <td>
                                                @if($match->created_at)
                                                <?php
                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC"));
                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                ?>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-warning border border-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">Volley</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th width="10%">Action</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>DateTime</th>
                                            <th>Title</th>
                                            <th>Tournament</th>
                                            <th>TeamOne</th>
                                            <th>TeamTwo</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($volleymatches) > 0)
                                        @foreach ($volleymatches as $match)
                                        <tr>
                                            <td>
                                                @if($match->status == 0 || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <a type="button" data-toggle="tooltip" data-placement="top"
                                                        data-trigger="hover" data-original-title="Edit"
                                                        class="btn btn-xs btn-icon btn-info btn-outline"
                                                        href="{{ route('matches_edit',['id'=>$match->id])}}">
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Match Details"
                                                    class="btn btn-xs btn-icon btn-primary btn-outline"
                                                    href="{{ route('matches_detail',['id'=>$match->id])}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Unpublished list"
                                                    class="btn btn-xs btn-icon btn-danger"
                                                    href="{{ route('matches_unpublished_list',['id'=>$match->id])}}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                @if($match->status == 0)
                                                    <span class="badge badge-dark">Draft</span>
                                                @elseif($match->status == 1)
                                                    <span class="badge badge-primary">OnBet</span>
                                                @elseif($match->status == 2)
                                                    <span class="badge badge-success">Go Dashboard</span>
                                                @elseif($match->status == 3)
                                                    <span class="badge badge-success">Live</span>
                                                @elseif($match->status == 7)
                                                    <span class="badge badge-success">Hide form user</span>
                                                @endif
                                            </td>
                                            <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif
                                            <td>
                                                @if($match->matchDateTime)
                                                    {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                @endif
                                            </td>
                                            <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>
                                            <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif
                                            </td>
                                            <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif
                                            </td>
                                            <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif
                                            </td>
                                            <td>
                                                @if($match->created_at)
                                                <?php
                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC"));
                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                ?>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered panel-dark border border-dark">
                    <div class="panel-heading">
                        <h3 class="panel-title">Tennis</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                    <thead>
                                        <tr>
                                            <th width="10%">Action</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>DateTime</th>
                                            <th>Title</th>
                                            <th>Tournament</th>
                                            <th>TeamOne</th>
                                            <th>TeamTwo</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($tennismatches) > 0)
                                        @foreach ($tennismatches as $match)
                                        <tr>
                                            <td>
                                                @if($match->status == 0 || Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <a type="button" data-toggle="tooltip" data-placement="top"
                                                        data-trigger="hover" data-original-title="Edit"
                                                        class="btn btn-xs btn-icon btn-info btn-outline"
                                                        href="{{ route('matches_edit',['id'=>$match->id])}}">
                                                        <i class="icon wb-edit" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Match Details"
                                                    class="btn btn-xs btn-icon btn-primary btn-outline"
                                                    href="{{ route('matches_detail',['id'=>$match->id])}}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>

                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                    data-trigger="hover" data-original-title="Unpublished list"
                                                    class="btn btn-xs btn-icon btn-danger"
                                                    href="{{ route('matches_unpublished_list',['id'=>$match->id])}}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>

                                            </td>
                                            <td>
                                                @if($match->status == 0)
                                                    <span class="badge badge-dark">Draft</span>
                                                @elseif($match->status == 1)
                                                    <span class="badge badge-primary">OnBet</span>
                                                @elseif($match->status == 2)
                                                    <span class="badge badge-success">Go Dashboard</span>
                                                @elseif($match->status == 3)
                                                    <span class="badge badge-success">Live</span>
                                                @elseif($match->status == 7)
                                                    <span class="badge badge-success">Hide form user</span>
                                                @endif
                                            </td>
                                            <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif
                                            <td>
                                                @if($match->matchDateTime)
                                                    {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                @endif
                                            </td>
                                            <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>
                                            <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif
                                            </td>
                                            <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif
                                            </td>
                                            <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif
                                            </td>
                                            <td>
                                                @if($match->created_at)
                                                <?php
                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $match->created_at, new DateTimeZone("UTC"));
                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                ?>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- End Page -->

<div class="md-fab-wrapper branch-create">
    <a title="Create Team" id="add_branch_button" href="{{ route('matches_create') }}"
        class="md-fab md-fab-accent branch-create">
        <i class="fa fa-plus"></i>
    </a>
</div>

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    <style>
        .md-fab-wrapper {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1004;
            -webkit-transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
            transition: margin 280ms cubic-bezier(.4, 0, .2, 1);
        }

        .md-fab.md-fab-accent {
            background: #17a2b8;
        }

        .md-fab {
            box-sizing: border-box;
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: #fff;
            color: #727272;
            display: block;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
            -webkit-transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1);
            border: none;
            position: relative;
            text-align: center;
            cursor: pointer;
        }

        .md-fab.md-fab-accent>i {
            color: #fff;
        }

        .md-fab>i {
            font-size: 20px;
            line-height: 66px;
            height: inherit;
            width: inherit;
            position: absolute;
            left: 0;
            top: 0;
            color: #727272;
        }
    </style>
@endsection


@section('page_scripts')
@include('backend.partials._scripts')
@include('backend.partials._datatable_script')
<script type="text/javascript">
    $('#matchManage').addClass('active open');
    $('#matchManageChildLi').addClass('active');
</script>
@endsection
