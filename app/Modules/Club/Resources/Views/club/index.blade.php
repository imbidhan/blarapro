@extends('backend.backendMaster')
@section('title', 'Club Manage')
@section('page_title', 'Club Manage')
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
                                        <table class="table table-hover dataTable table-striped w-full" id="exampleTableTools">
                                            <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>ClubUsername</th>
                                                <th>UsersNumber</th>
                                                @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                <th>Total Balance</th>
                                                <th>Total Profit</th>
                                                <th>Total Withdraw</th>
                                                @endif
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>CreatedBy</th>
                                                <th>Created At</th>
                                                @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <th>Userinfo</th>
                                                    <th>Change Status</th>
                                                @endif
                                            </tr>
                                            </thead>

                                            <tfoot>
                                            <tr>
                                                <th>Action</th>
                                                <th>ClubUsername</th>
                                                <th>UsersNumber</th>
                                                @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                <th>Total Balance</th>
                                                <th>Total Profit</th>
                                                <th>Total Withdraw</th>
                                                @endif
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>CreatedBy</th>
                                                <th>Created At</th>
                                                @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                    <th>Userinfo</th>
                                                    <th>Change Status</th>
                                                @endif
                                            </tr>
                                            </tfoot>

                                            <tbody>
                                            @if($clubs)
                                                @foreach($clubs as $club)
                                                    <tr>
                                                        <td>
                                                            <a type="button" data-toggle="tooltip" data-placement="top"
                                                               data-trigger="hover" data-original-title="Edit"
                                                               class="btn btn-icon btn-xs btn-info btn-outline"
                                                               href="{{ route('club_edit',['id' => $club->id]) }}">
                                                                <i class="icon wb-edit" aria-hidden="true"></i>
                                                            </a>

                                                            <a type="button" data-toggle="tooltip" data-placement="top"
                                                               data-trigger="hover" data-original-title="Change Password"
                                                               class="btn btn-icon btn-xs btn-danger btn-outline"
                                                               href="{{ route('club_user_password_change',['id' => $club->id]) }}">
                                                                <i class="fa fa-key" aria-hidden="true"></i>
                                                            </a>
                                                            <a type="button" data-toggle="tooltip" data-placement="top"
                                                               data-trigger="hover" data-original-title="Club User List"
                                                               class="btn btn-icon btn-xs btn-primary btn-outline"
                                                               href="{{ route('every_club_total_user_list',['id' => $club->id]) }}">
                                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        <td> {{ $club->username }} </td>
                                                        <td> {{ $club->users->count() }} </td>
                                                        @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                        <td> {{ $club->totalBalance }} </td>
                                                        <td> {{ $club->totalProfit }} </td>
                                                        <td> {{ $club->totalWithdrawAmount }} </td>
                                                        @endif
                                                        <td> {{ $club->phone }} </td>
                                                        <td> {{ $club->email }} </td>
                                                        <td>
                                                            @if($club->status == 0)
                                                                <span class="badge badge-round badge-warning">In active</span>
                                                            @endif

                                                            @if($club->status == 1)
                                                                <span class="badge badge-round badge-success">Active</span>
                                                            @endif

                                                            @if($club->status == 2)
                                                                <span class="badge badge-round badge-danger">Password Change</span>
                                                            @endif

                                                        </td>
                                                        <td> @if($club->created_by){{ $club->userCreated->userRole->name}}@endif </td>
                                                        <td>
                                                            @if($club->created_at)
                                                                <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $club->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                                ?>
                                                            @endif
                                                        </td>
                                                        @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                                        <td>
                                                            @if($club->userInfo){{ $club->userInfo}}@endif
                                                        </td>
                                                        <td>
                                                            <form action="{{ route("club_status_change") }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $club->id }}"/>
                                                                <select name="status" class="form-control mb-1">
                                                                    <option value="0" @if($club->status == 0) selected @endif>Account Lock</option>
                                                                    <option value="1" @if($club->status == 1) selected @endif>Account published</option>
                                                                    <option @if($club->status == 2) selected @endif>Account password changed</option>
                                                                </select>
                                                                <input onclick="return confirm('Are you sure')" class="btn btn-primary btn-sm" type="submit" value="Change Status"/>
                                                            </form>

                                                        </td>
                                                        @endif
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

    <div class="md-fab-wrapper branch-create">
        <a title="Create betoptions" id="add_branch_button" href="{{ route('club_create') }}"
           class="md-fab md-fab-accent branch-create">
            <i class="fa fa-plus"></i>
        </a>
    </div>

@endsection

@section('page_styles')
    @include('backend.partials._styles')
    @include('backend.partials._datatable_style')
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
        $('#clubManage').addClass('active open');
        $('#clubManageChildLi').addClass('active');
    </script>
@endsection
