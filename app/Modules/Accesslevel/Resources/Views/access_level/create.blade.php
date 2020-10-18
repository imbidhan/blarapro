@extends('backend.backendMaster')
@section('title', 'Access Level')
@section('page_title', 'Access controll page')
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
                                        <form action="{{ route('access_level_store') }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf

                                            <div class="form-group">
                                                <div class="input-group input-group-icon">

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            Select Role  <span class="required text-danger"> &nbsp; *</span>
                                                        </div>
                                                    </div>

                                                    <select class="form-control" id="role_id" name="role_id" required="">
                                                        <option value="">Choose a Role</option>
                                                        @if($roles)
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id}}">{{ ucfirst($role->name)}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="example table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Module</th>
                                                            <th class="text-center">Create</th>
                                                            <th class="text-center">Read</th>
                                                            <th class="text-center">Update</th>
                                                            <th class="text-center">Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if($modules)
                                                            @foreach($modules as $module)
                                                                <tr>
                                                                    <td>
                                                                        {{ ucfirst($module->module_name ) }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox-custom checkbox-primary">
                                                                            <input type="hidden" name="module[]" value="{{ $module->id }}">
                                                                            <input type="checkbox" name="create_{{ $module->id }}" id="create_{{ $module->id }}" />
                                                                            <label></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox-custom checkbox-info">
                                                                            <input type="checkbox" name="read_{{ $module->id }}" id="read_{{ $module->id }}" />
                                                                            <label></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox-custom checkbox-warning">
                                                                            <input type="checkbox" name="update_{{ $module->id }}" id="update_{{ $module->id }}" />
                                                                            <label></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox-custom checkbox-danger">
                                                                            <input type="checkbox" name="delete_{{ $module->id }}" id="delete_{{ $module->id }}" />
                                                                            <label></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                                                                            
                                            <div class="row row-lg">
                                                <div class="form-group col-xl-2 padding-top-m">
                                                    <button type="submit" class="btn btn-info" id="validateButton1">Submit</button>
                                                </div>
                                            </div>

                                        </form>
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
        $('#role_id').change(function(){
            var id = $("#role_id :selected").val();
            var base_url = window.location.origin;
            var redirect_url = base_url + '/admin/settings/access-level/edit/' + id;
            window.location.href = redirect_url;
        });
    </script>
@endsection