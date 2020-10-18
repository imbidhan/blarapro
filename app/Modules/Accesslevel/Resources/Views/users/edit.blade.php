@extends('backend.backendMaster')
@section('title', 'User Update')
@section('page_title', 'User update')
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

                            <div class="col-md-7">
                                <div class="p-5">
                                    <form action="{{ route('user_update_access_level' , $user->id) }}" method="POST"
                                        enctype="multipart/form-data" id="exampleFullForm" autocomplete="off">
                                        @csrf
                                        <div class="row row-lg">
                                            <div class="col-xl-6 form-horizontal">


                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="icon wb-user" aria-hidden="true"></span>
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="full name"
                                                            value="@if($user){{ trim($user->name) }}@endif" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="icon wb-envelope"
                                                                    aria-hidden="true"></span>
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="email"
                                                            value="@if($user){{ trim($user->email) }}@endif"
                                                            placeholder="Email" required="">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="icon wb-mobile" aria-hidden="true"></span>
                                                            </div>
                                                        </div>
                                                        <input type="text" class="form-control" name="phone"
                                                            value="@if($user){{ trim($user->phone)}}@endif"
                                                            placeholder="Phone number">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="icon wb-upload" aria-hidden="true"></span>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="image" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="input-group input-group-icon">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <span class="fa fa-rocket" aria-hidden="true"></span>
                                                                <span class="required text-danger">*</span>
                                                            </div>
                                                        </div>
                                                        <select class="form-control" id="role_id" name="role_id"
                                                            required="">
                                                            <option value="">Choose a Role</option>
                                                            @if($roles)
                                                            @foreach ($roles as $role)
                                                            <option value="{{ $role->id}}" @if($user->role_id ==
                                                                $role->id) selected="selected" @endif >
                                                                {{ ucfirst($role->name)}}
                                                            </option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row row-lg">
                                            <div class="form-group col-xl-2 padding-top-m">
                                                <button type="submit" class="btn btn-info" id="validateButton1">Update
                                                    User Info</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                            <div class="col-md-2">
                                @if($user->image)
                                <img class="rounded" src="{{ asset($user->image) }}" alt="profile image" width="100" />
                                @else
                                <img class="rounded" src="{{ asset('/backend/uploads/users/default.jpg') }}" alt="profile image" width="100" />
                                @endif
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
@include('backend.partials._formvalidation_style')
@endsection


@section('page_scripts')
@include('backend.partials._scripts')
@include('backend.partials._formvalidation_script')
<script src="{{ asset('/validation/userValidation.js') }}"></script>
@endsection
