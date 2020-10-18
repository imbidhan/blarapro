<?php

namespace App\Modules\Accesslevel\Http\Controllers;

use Exception;

use Illuminate\Http\Request;
use App\Models\AccessLevel\Role;
use App\Models\AccessLevel\Modules;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\AccessLevel\AccessLevel;

class AccessLevelController extends Controller
{
    #Access control view
    public function create()
    {
        $roles = Role::all();
        $modules = Modules::all();

        return view('accesslevel::access_level.create', compact('roles', 'modules'));
    }

    #Access control store
    public function store(Request $request)
    {
        $access_level_data = $request->all();
        $modules = Modules::all();

        $role_id = $access_level_data['role_id'];
        $user_id = Auth::guard("admin")->user()->id;

        try
        {
            foreach($modules as $module)
            {
                $module_id = $module->id;

                if(isset($access_level_data['create_'.$module_id])){
                    $create = 1;
                }else{
                    $create = 0;
                }

                if(isset($access_level_data['read_'.$module_id])){
                    $read = 1;
                }else{
                    $read = 0;
                }

                if(isset($access_level_data['update_'.$module_id])){
                    $update = 1;
                }else{
                    $update = 0;
                }

                if(isset($access_level_data['delete_'.$module_id])){
                    $delete = 1;
                }else{
                    $delete = 0;
                }

                $access_level_count = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->count();

                if($access_level_count > 0) {

                    $access_level = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->first();

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;
                    $access_level->update();

                } else {

                    $access_level = new AccessLevel;

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;
                    $access_level->save();

                }
            }

            Toastr::success("Access level updated successfully!","Success!");
            return redirect()->route('access_level_create');

        }
        catch (Exception $e)
        {
            Toastr::success("Sorry something went wrong! Data cannot updated successfully!","Warning!");
            return redirect()->route('access_level_create');
        }
    }

    #Edit access control
    public function edit($id)
    {
        $role_id = $id;
        $roles = Role::all();
        $access_levels = AccessLevel::where('role_id', $role_id)->get();

        return view('accesslevel::access_level.edit', compact('roles','access_levels', 'role_id'));
    }

    #Update access control
    public function update(Request $request)
    {
        //return $this->store($request);
        $access_level_data = $request->all();
        $modules = Modules::all();
        $role_id = $access_level_data['role_id'];
        $user_id = Auth::guard("admin")->user()->id;

        try
        {
            foreach($modules as $module)
            {
                $module_id = $module->id;

                if(isset($access_level_data['create_'.$module_id])) {
                    $create = 1;
                }else{
                    $create = 0;
                }

                if(isset($access_level_data['read_'.$module_id])){
                    $read = 1;
                } else{
                    $read = 0;
                }

                if(isset($access_level_data['update_'.$module_id])){
                    $update = 1;
                }else{
                    $update = 0;
                }

                if(isset($access_level_data['delete_'.$module_id])){
                    $delete = 1;
                }else{
                    $delete = 0;
                }

                $access_level_count = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->count();

                if($access_level_count > 0)
                {
                    $access_level = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->first();

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->update();
                }
                else
                {
                    $access_level = new AccessLevel;

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->save();
                }
            }
            Toastr::success("Access level updated successfully!","Success!");
            return redirect()->route('access_level_edit', ['id' => $role_id]);

        }
        catch (Exception $e)
        {
            Toastr::success("Sorry something went wrong! Data cannot updated successfully!","Warning!");
            return redirect()->route('access_level_edit', ['id' => $role_id]);
        }
    }

}
