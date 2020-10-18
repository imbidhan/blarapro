@extends('backend.backendMaster')
@section('title', 'Close Matches List')
@section('page_title', 'Close Matches List')
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

                    <div class="panel panel-bordered panel-info border border-info">

                        <div class="panel-heading">
                            <h3 class="panel-title">@yield('page_title')</h3>
                        </div>

                        <div class="p-2">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="p-5">
                                        <table class="table table-hover table-striped w-full table-responsive-sm table-responsive-md table-responsive-lg">
                                            <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>DateTime</th>
                                                <th>Title</th>
                                                <th>Tournament</th>
                                                <th>TeamOne</th>
                                                <th>TeamTwo</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Action</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                                <th>DateTime</th>
                                                <th>Title</th>
                                                <th>Tournament</th>
                                                <th>TeamOne</th>
                                                <th>TeamTwo</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @if(count($matches) > 0)
                                                @foreach ($matches as $match)
                                                    <tr>
                                                        <td>
                                                            @if($match->status == 5)
                                                                <a type="button" data-toggle="tooltip" data-placement="top"
                                                                   data-trigger="hover" data-original-title="Match Details"
                                                                   class="btn btn-xs btn-icon btn-success btn-outline"
                                                                   href="{{ route('matches_detail_close',['id'=>$match->id])}}">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($match->status == 5)
                                                                <span class="badge badge-success">Close</span>
                                                            @endif
                                                        </td>
                                                        <td>@if($match->sport_id){{ ucfirst($match->sportName) }}@endif</td>
                                                        <td>
                                                            @if($match->matchDateTime)
                                                                {{ date("d M y h:i A",strtotime($match->matchDateTime)) }}
                                                            @endif
                                                        </td>
                                                        <td>@if($match->matchTitle){{ ucfirst($match->matchTitle) }}@else Title not given @endif</td>
                                                        <td>@if($match->tournament_id){{ ucfirst($match->tournamentName) }}@endif</td>
                                                        <td>@if($match->teamOne_id){{ ucfirst($match->teamOne) }}@endif</td>
                                                        <td>@if($match->teamTwo_id){{ ucfirst($match->teamTwo) }}@endif</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="8"><h4 class="text-center text-warning">No Match Close</h4></td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        {!! $matches->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    <script type="text/javascript">
        $('#matchManage').addClass('active open');
        $('#matchCloseLi').addClass('active');
    </script>
@endsection
