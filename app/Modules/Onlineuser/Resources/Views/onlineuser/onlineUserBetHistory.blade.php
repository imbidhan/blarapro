@extends('backend.backendMaster')
@section('title', 'Online user bet history')
@section('page_title', 'Online user bet history')
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
                                        <table style="font-size: 12px;" class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
                                            <thead>
                                            <tr>
                                                <th>MatchTime</th>
                                                <th>BetTime</th>
                                                <th>Question</th>
                                                <th>UserAns</th>
                                                <th>Status</th>
                                                <th>Team</th>
                                                <th>Sport</th>
                                                <th>Match</th>
                                                <th>RightAns</th>
                                                <th>BetAmount</th>
                                                <th>BetRate</th>
                                                <th>BetProfit</th>
                                                <th>BetLost</th>
                                                <th>Partial</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @if($betHistories)
                                                @foreach($betHistories as $betHistory)
                                                    <tr>
                                                        <td>
                                                            {{ date("d-M-y h:i A",strtotime($betHistory->matchDateTime)) }}
                                                        </td>
                                                        <td>
                                                            @if($betHistory->created_at)
                                                                <?php
                                                                    $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $betHistory->created_at, new DateTimeZone("UTC"));
                                                                    echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d-m-y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        <td>{{ ucfirst($betHistory->question) }}</td>
                                                        <td>{{ $betHistory->userAns }}</td>
                                                        <td>
                                                            @if($betHistory->winLost == 'match upcoming')
                                                                <span class="badge badge-primary">{{ ucwords($betHistory->winLost) }}</span>
                                                            @elseif($betHistory->winLost == 'match live')
                                                                <span class="badge badge-primary">{{ ucwords($betHistory->winLost) }}</span>
                                                            @elseif($betHistory->winLost == 'win')
                                                                <span class="badge badge-success">{{ ucwords($betHistory->winLost) }}</span>
                                                            @elseif($betHistory->winLost == 'lost')
                                                                <span class="badge badge-warning">{{ ucwords($betHistory->winLost) }}</span>
                                                            @elseif($betHistory->winLost == 'bet return')
                                                                <span class="badge badge-danger">{{ $betHistory->winLost }}</span>
                                                            @else
                                                                <span class="badge badge-warning">{{ ucwords($betHistory->winLost) }} % </span>
                                                        @endif
                                                        </td>
                                                        <td>
                                                            {{ ucfirst($betHistory->teamOne) }}
                                                            VS
                                                            {{ ucfirst($betHistory->teamTwo) }}
                                                        </td>
                                                        <td>{{ ucfirst($betHistory->sportName) }}</td>
                                                        <td>{{ $betHistory->matchTitle }}</td>
                                                        <td>
                                                            @if($betHistory->rightAns != null)
                                                                {{ $betHistory->rightAns }}
                                                                @else
                                                                Running
                                                            @endif
                                                        </td>
                                                        <td>{{ $betHistory->betAmount }}</td>
                                                        <td>{{ $betHistory->betRate }}</td>
                                                        <td>{{ $betHistory->betProfit }}</td>
                                                        <td>{{ $betHistory->betLost }}</td>
                                                        <td>{{ $betHistory->partialLost }}</td>
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

    </div>
    <!-- End Page -->

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
@endsection


@section('page_scripts')
    @include('backend.partials._scripts')
    @include('backend.partials._datatable_script')
    <script type="text/javascript">
        $('#OnlineUserManage').addClass('active open');
        $('#OnlineUserManageChild').addClass('active');
    </script>
@endsection
