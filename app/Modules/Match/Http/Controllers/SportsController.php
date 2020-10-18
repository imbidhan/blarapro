<?php

namespace App\Modules\Match\Http\Controllers;

use Exception;

use App\Models\Match\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    #Sports List
    public function index() {
        $sports = Sport::where('status',1)->get();
        return view('match::sports.index', compact('sports'));
    }

    #Sports Create
    public function create() {
        return view('match::sports.create');
    }

    #Sports Store
    public function store(Request $request) {

        $this->validate($request,[
            'sportName' => 'required|unique:sports',
        ],[
            'sportName.required' => 'Sports name required',
            'sportName.unique' => 'Sports name already taken',
        ]);

        try {

            $sports = new Sport();
            $sports->sportName = trim(strip_tags(strtolower($request->sportName)));
            $sports->created_by = Auth::guard("admin")->user()->id;
            $sports->save();

            Toastr::success("Sports created Successfully","Success!");
            return redirect()->route('sport_create');

        } catch (Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('sport_create');
        }

    }

    #Sport Edit
    /*public function edit($id) {
        $sport = Sport::find($id);
        return view('match::sports.edit', compact('sport'));
    }*/


    #Sport Update
    /*public function update(Request $request , $id) {

        $this->validate($request,[
            'sportName' => 'required|unique:sports,sportName,'.$id,
        ],[
            'sportName.required' => 'Sports name required',
            'sportName.unique' => 'Sports name already taken',
        ]);

        try{
            $sport = Sport::find($id);
            $sport->sportName = trim(strip_tags(strtolower($request->sportName)));
            $sport->updated_by = Auth::guard("admin")->user()->id;
            $sport->updated_at = Carbon::now();
            $sport->update();

            Toastr::success("Sports updated Successfully","Success!");
            return redirect()->route('sports_edit',['id'=>$id]);

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('sports_edit',['id'=>$id]);
        }
    }*/

    #Sport delete
    /*public function destroy ($id) {

        try{
            $sport = Sport::find($id);
            $sport->status = 0;
            $sport->update();

            Toastr::success("Sports deleted Successfully","Success!");
            return redirect()->route('sports_manage');

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('sports_manage');
        }
    }*/
}
