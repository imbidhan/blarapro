@extends('backend.backendMaster')
@section('title', 'Role Updated')
@section('page_title', 'Role updated')
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
                                    @if($role)
                                        <div class="p-5">
                                            <form action="{{ route('role_update', ['id' => $role->id]) }}" method="POST" id="exampleFullForm" autocomplete="off">
                                                @csrf
                                                <div class="row row-lg">
                                                    <div class="col-xl-6 form-horizontal">
                                                        <div class="form-group row">
                                                            <label class="col-xl-12 col-md-3 form-control-label">Role name
                                                                <span class="required text-danger">*</span>
                                                            </label>
                                                            <div class=" col-xl-12 col-md-9">
                                                                <input type="text" class="form-control" name="name" placeholder="Ex: admin"
                                                                required="" value="{{ $role->name }}">
                                                            </div>
                                                        </div>
                                                                                
                                                        <div class="form-group row">
                                                            <label class="col-xl-12 col-md-3 form-control-label">Description
                                                                <span class="required text-danger">*</span>
                                                            </label>
                                                            <div class="col-xl-12 col-md-9">
                                                                <textarea class="form-control" name="description" rows="3" placeholder="Describe about your role"
                                                                required="">{{ $role->description }}</textarea>
                                                            </div>
                                                        </div>
                                                </div>
                                                </div>
                                                
                                                <div class="row row-lg">
                                                    <div class="form-group col-xl-2 padding-top-m">
                                                        <button type="submit" class="btn btn-info" id="validateButton1">Update</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
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
    <script src="{{ asset('/validation/roleValidation.js') }}"></script>
@endsection