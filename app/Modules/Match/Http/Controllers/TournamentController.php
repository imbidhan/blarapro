<?php

namespace App\Modules\Match\Http\Controllers;

use Exception;

use App\Models\Match\Tournament;
use App\Models\Match\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class TournamentController extends Controller
{
    #Tournament List
    public function index() {
        $tournaments = Tournament::where('status',1)->orderBy('created_at','desc')->get();
        return view('match::tournaments.index',compact('tournaments'));
    }

    #Tournament create
    public function create() {
        $sports = Sport::where('status',1)->get();
        return view('match::tournaments.create',compact('sports'));
    }

    #Tournament Store
    public function store(Request $request) {

        $this->validate($request,[
            'tournamentName' => 'required',
            'sport_id' => 'required'
        ],[
            'tournamentName.required' => 'Tournament name required',
            'sport_id.required' => 'Please select one sports caregory',
        ]);

        $alreadyTournamentHave = Tournament::where(["sport_id"=>trim(strip_tags($request->sport_id)),"tournamentName"=>trim(strip_tags(strtolower($request->tournamentName)))])->first();
        if(!empty($alreadyTournamentHave)){
            Toastr::warning("Tournament already created!","Success!");
            return redirect()->back();
        }

        try{

            $tournament = new Tournament();
            $tournament->sport_id = trim(strip_tags($request->sport_id));
            $tournament->tournamentName = trim(strip_tags(strtolower($request->tournamentName)));
            $tournament->created_by = Auth::guard("admin")->user()->id;
            $tournament->save();

            Toastr::success("Tournament created successfully!","Success!");
            return redirect()->route("tournaments_create");

        }catch(Exception $e) {
            Toastr::warning("Sorry! something went wrong!","Warning!");
            return redirect()->route("tournaments_create");
        }
    }

    #Tournament Edit
    public function edit($id) {
        $tournament  = Tournament::find($id);
        $sports = Sport::where('status',1)->get();
        return view('match::tournaments.edit',compact('tournament','sports'));
    }


    #Tournament Update
    public function update(Request $request, $id) {

        $this->validate($request,[
            'tournamentName' => 'required',
            'sport_id' => 'required'
        ],[
            'tournamentName.required' => 'Tournament name required',
            'sport_id.required' => 'Please select one sports caregory',
        ]);

        try{

            $team = Tournament::find($id);
            $team->sport_id = trim(strip_tags($request->sport_id));
            $team->tournamentName = trim(strip_tags(strtolower($request->tournamentName)));
            $team->updated_by = Auth::guard("admin")->user()->id;
            $team->updated_at = Carbon::now();
            $team->update();

            Toastr::success("Tournament updated successfully!","Success!");
            return redirect()->route("tournaments_edit",['id'=>$id]);

        }catch(Exception $e) {
            Toastr::warning("Sorry! something went wrong!","Warning!");
            return redirect()->route("tournaments_edit",['id'=>$id]);
        }
    }

    #Tournament delete
    public function destroy ($id) {

        try{

            $team = Tournament::find($id);
            $team->status = 0;
            $team->update();

            Toastr::success("Tournament deleted Successfully","Success!");
            return redirect()->route('tournaments_manage');

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('tournaments_manage');
        }
    }
}
