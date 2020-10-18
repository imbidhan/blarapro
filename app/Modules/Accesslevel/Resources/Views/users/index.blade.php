@extends('backend.backendMaster')
@section('title', 'User & Role')
@section('page_title', 'User and Role')
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

                            <div class="col-md-3">
                                @include('backend.partials.settings._menu')
                            </div>

                            <div class="col-md-9">
                                <div class="p-5">
                                    <table class="table table-hover dataTable table-striped w-full"
                                        id="exampleTableTools">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Change Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Change Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        @if(count($users) > 0)
                                            @php($i=1)
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td> {{ $user->email }} </td>
                                                    <td>{{  $user->userRole->name }}</td>
                                                    <td>
                                                        @if($user->status == 1)
                                                            <p class="mt-4"><span class="badge badge-pill badge-success up">Account Published </span></p>
                                                        @endif
                                                        @if($user->status == 0)
                                                            <p class="mt-4"><span class="badge badge-pill badge-danger up">Account Lock </span></p>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form action="{{ route("admin_user_status_change") }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $user->id }}"/>
                                                            <select name="status" class="form-control">
                                                                <option value="0" @if($user->status == 0) selected @endif>Account Lock</option>
                                                                <option value="1" @if($user->status == 1) selected @endif>Account published</option>
                                                            </select>
                                                            <input class="btn btn-primary btn-sm" type="submit" value="Change Status" />
                                                        </form>
                                                    </td>
                                                    <td>

                                                        <a type="button" data-toggle="tooltip" data-placement="top"
                                                           data-trigger="hover" data-original-title="Edit"
                                                           class="btn btn-icon btn-info btn-outline btn-xs"
                                                           href="{{ route('user_edit_access_level',['id' => $user->id]) }}">
                                                            <i class="icon wb-edit" aria-hidden="true"></i>
                                                        </a>

                                                        <a type="button" data-toggle="tooltip" data-placement="top"
                                                           data-trigger="hover" data-original-title="Change role"
                                                           class="btn btn-icon btn-primary btn-outline btn-xs"
                                                           href="{{ route('user_role',['id' => $user->id]) }}">
                                                            <i class="fa fa-rocket" aria-hidden="true"></i>
                                                        </a>

                                                        <a type="button" data-toggle="tooltip" data-placement="top"
                                                           data-trigger="hover" data-original-title="Change password"
                                                           class="btn btn-icon btn-warning btn-outline btn-xs"
                                                           href="{{ route('user_password',['id' => $user->id]) }}">
                                                            <i class="fa fa-key" aria-hidden="true"></i>
                                                        </a>

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

</div>
<!-- End Page -->

<div class="md-fab-wrapper branch-create">
    <a title="Create User" id="add_branch_button" href="{{ route('user_create_access_level') }}" class="md-fab md-fab-accent branch-create">
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
@endsection
