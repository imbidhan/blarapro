@extends('backend.backendMaster')
@section('title', 'Edit access Level')
@section('page_title', 'Edit access level')
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
                                        <form action="{{ route('access_level_update') }}" method="POST" id="exampleFullForm" autocomplete="off">
                                            @csrf

                                            <div class="form-group">
                                                <div class="input-group input-group-icon">

                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            Select Role  <span class="required text-danger"> &nbsp; *</span>
                                                        </div>
                                                    </div>

                                                    <select class="form-control" id="role_id" name="role_id" required="">
                                                        @if($roles)
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->id}}" @if($role->id == $role_id) selected="selected" @endif>{{ ucfirst($role->name)}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                            
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width:400px">Module</th>
                                                        <th > 
                                                            <div style="padding:0;text-align:left;"class="checkbox-custom checkbox-primary">
                                                                Create &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="checkbox" id="all_mark" />
                                                                <label></label>
                                                            </div>
                                                        </th>
                                                        <th >
                                                            <div style="padding:0;text-align:left;"class="checkbox-custom checkbox-info">
                                                                Read &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="checkbox" id="all_mark2" />
                                                                <label></label>
                                                            </div>
                                                        </th>
                                                        <th >
                                                            <div style="padding:0;text-align:left;"class="checkbox-custom checkbox-warning">
                                                                Update &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="checkbox" id="all_mark3" />
                                                                <label></label>
                                                            </div>
                                                        </th>
                                                        <th >
                                                            <div style="padding:0;text-align:left;"class="checkbox-custom checkbox-danger">
                                                                Delete &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input type="checkbox" id="all_mark4" />
                                                                <label></label>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>

                                            <div class="panel-group" id="accordionDefault" aria-multiselectable="true" role="tablist">
                                                <div class="panel ">
                                                    <div class="panel-heading" id="accordionOne" role="tab">
                                                        <a class="panel-title" data-toggle="collapse" href="#settings"
                                                        data-parent="#accordionDefault" aria-expanded="true" aria-controls="settings">  Settings </a>
                                                    </div>
                                                    <div class="panel-collapse collapse show" id="settings" aria-labelledby="accordionOne"
                                                        role="tabpanel">
                                                        <div class="">
                                                            <table class="table table-bordered">
                                                                @if($access_levels)
                                                                    @foreach($access_levels as $access_level)
                                                                        @if($access_level->module->id >= 1 && $access_level->module->id <= 5)
                                                                        <tr>
                                                                            <td style="width:400px">{{ucfirst(trim($access_level->module->module_name))}}</td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-primary">
                                                                                    <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                                    <input class="aa" type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" @if($access_level->create == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-info">
                                                                                    <input class="bb" type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" @if($access_level->read == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-warning">
                                                                                    <input class="cc" type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}" @if($access_level->update == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-danger">
                                                                                    <input class="dd" type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" @if($access_level->delete == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="panel">
                                                    <div class="panel-heading" id="accordionTwo" role="tab">
                                                        <a class="panel-title collapsed" data-toggle="collapse" href="#vattax" 
                                                        data-parent="#accordionDefault" aria-expanded="false" aria-controls="vattax"> Vat tax
                                                        </a>
                                                    </div>
                                                    <div class="panel-collapse collapse" id="vattax" aria-labelledby="accordionTwo" role="tabpanel">
                                                        <div class="">
                                                            <table class="table table-bordered">
                                                                @if($access_levels)
                                                                    @foreach($access_levels as $access_level)
                                                                        @if($access_level->module->id >= 6 && $access_level->module->id <= 10)
                                                                        <tr>
                                                                            <td style="width:400px">{{ucfirst(trim($access_level->module->module_name))}}</td></td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-primary">
                                                                                    <input type="hidden" name="module[]" value="{{ $access_level->module->id }}">
                                                                                    <input class="aa" type="checkbox" name="create_{{ $access_level->module->id }}" id="create_{{ $access_level->module->id }}" @if($access_level->create == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-info">
                                                                                    <input class="bb" type="checkbox" name="read_{{ $access_level->module->id }}" id="read_{{ $access_level->module->id }}" @if($access_level->read == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-warning">
                                                                                    <input class="cc" type="checkbox" name="update_{{ $access_level->module->id }}" id="update_{{ $access_level->module->id }}" @if($access_level->update == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="checkbox-custom checkbox-danger">
                                                                                    <input class="dd" type="checkbox" name="delete_{{ $access_level->module->id }}" id="delete_{{ $access_level->module->id }}" @if($access_level->delete == 1) checked="checked" @endif/>
                                                                                    <label></label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script type="text/javascript">
        $('#all_mark').click(function() {   
            $('.aa').each(function(){
                if($('#all_mark').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark2').click(function() {   
            $('.bb').each(function(){
                if($('#all_mark2').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark3').click(function() {   
            $('.cc').each(function(){
                if($('#all_mark3').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });

        $('#all_mark4').click(function() {   
            $('.dd').each(function(){
                if($('#all_mark4').is(':checked')){
                    $(this).prop('checked',true);
                }
                else{
                    $(this).prop('checked',false);
                }
                
            })
        });
    </script>
@endsection