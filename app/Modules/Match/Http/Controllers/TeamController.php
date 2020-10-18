<?php

namespace App\Modules\Match\Http\Controllers;

use Exception;

use App\Models\Match\Team;
use App\Models\Match\Sport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    #Team List
    public function index() {
        $teams = Team::where('status',1)->orderBy('created_at','desc')->get();
        return view('match::teams.index',compact('teams'));
    }

    #Team create
    public function create() {
        $sports = Sport::where('status',1)->get();
        return view('match::teams.create',compact('sports'));
    }

    #Team Store
    public function store(Request $request) {

        $this->validate($request,[
            'teamName' => 'required',
            'sport_id' => 'required'
        ],[
            'teamName.required' => 'Team name required',
            'sport_id.required' => 'Please select one sports caregory',
        ]);

        $alreadyTeamHave = Team::where(["sport_id"=>trim(strip_tags($request->sport_id)),"teamName"=>trim(strip_tags(strtolower($request->teamName)))])->first();
        if(!empty($alreadyTeamHave)){
            Toastr::warning("Team already created!","Success!");
            return redirect()->back();
        }
        try{

            $team = new Team();
            $team->sport_id = trim(strip_tags($request->sport_id));
            $team->teamName = trim(strip_tags(strtolower($request->teamName)));
            $team->created_by = Auth::guard("admin")->user()->id;
            $team->save();

            Toastr::success("Team created successfully!","Success!");
            return redirect()->route("team_create");

        }catch(Exception $e) {
            Toastr::warning("Sorry! something went wrong!","Warning!");
            return redirect()->route("team_create");
        }
    }

    #Team Edit
    public function edit($id) {
        $team = Team::find($id);
        $sports = Sport::where('status',1)->get();
        return view('match::teams.edit',compact('team','sports'));
    }


    #Team Update
    public function update(Request $request, $id) {

        $this->validate($request,[
            'teamName' => 'required',
            'sport_id' => 'required'
        ],[
            'teamName.required' => 'Team name required',
            'sport_id.required' => 'Please select one sports caregory',
        ]);

        try{

            $team = Team::find($id);
            $team->sport_id = trim(strip_tags($request->sport_id));
            $team->teamName = trim(strip_tags(strtolower($request->teamName)));
            $team->updated_by = Auth::guard("admin")->user()->id;
            $team->updated_at = Carbon::now();
            $team->update();

            Toastr::success("Team updated successfully!","Success!");
            return redirect()->route("team_edit",['id'=>$id]);

        }catch(Exception $e) {
            Toastr::warning("Sorry! something went wrong!","Warning!");
            return redirect()->route("team_edit",['id'=>$id]);
        }
    }

    #Team delete
    public function destroy ($id) {

        try{

            $team = Team::find($id);
            $team->status = 0;
            $team->update();

            Toastr::success("Team deleted Successfully","Success!");
            return redirect()->route('team_manage');

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('team_manage');
        }
    }

}

