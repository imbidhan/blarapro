<?php

namespace App\Modules\Match\Http\Controllers;

use App\Models\Match\Sport;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Match\Betoption;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class BetoptionController extends Controller
{

    #Betoptions List
    public function index() {
        $betoptions = Betoption::orderBy('created_at','desc')->get();
        return view('match::betoptions.index', compact('betoptions'));
    }

    #Betoptions Create
    public function create() {
        $sports = Sport::where('status',1)->get();
        return view('match::betoptions.create',compact('sports'));
    }

    #Betoptions Store
    public function store(Request $request) {

        $this->validate($request,[
            'sport_id' => 'required',
            'betOptionName' => 'required',
        ],[
            'sport_id.required' => 'Sport name required',
            'betOptionName.required' => 'Betoptions name required',
        ]);
        $sport_id = trim(strip_tags(strtolower($request->sport_id)));

        $betOptionName = trim(strip_tags(strtolower($request->betOptionName)));

        $exitBetName = Betoption::where(['sport_id'=>$sport_id,'betOptionName'=>$betOptionName])->first();

        if($exitBetName){
            Toastr::warning("Bet title already exist","Warning!");
            return redirect()->route('betoptions_create');
        }

        try {

            $betoptions = new Betoption();
            $betoptions->sport_id = $sport_id;
            $betoptions->betOptionName = $betOptionName;
            $betoptions->created_by = Auth::guard("admin")->user()->id;
            $betoptions->save();

            Toastr::success("Betoptions created Successfully","Success!");
            return redirect()->route('betoptions_create');

        } catch (Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('betoptions_create');
        }

    }

    #Betoption Edit
    public function edit($id) {
        $sports = Sport::where('status',1)->get();
        $betoption = Betoption::find($id);
        return view('match::betoptions.edit', compact('betoption','sports'));
    }


    #Betoption Update
    public function update(Request $request , $id) {

        $this->validate($request,[
            'sport_id' => 'required',
            'betOptionName' => 'required',
        ],[
            'sport_id.required' => 'Sport name required',
            'betOptionName.required' => 'Betoptions name required',
        ]);
        $sport_id = trim(strip_tags(strtolower($request->sport_id)));
        $betOptionName = trim(strip_tags(strtolower($request->betOptionName)));

        $exitBetName = Betoption::where(['sport_id'=>$sport_id,'betOptionName'=>$betOptionName])->first();

        if($exitBetName){
            Toastr::warning("Bet title already exist","Warning!");
            return redirect()->back();
        }

        try{
            $betoption = Betoption::find($id);
            $betoption->sport_id = $sport_id;
            $betoption->betOptionName = $betOptionName;
            $betoption->updated_by = Auth::guard("admin")->user()->id;
            $betoption->updated_at = Carbon::now();
            $betoption->save();

            Toastr::success("Betoptions updated Successfully","Success!");
            return redirect()->route('betoptions_edit',['id'=>$id]);

        }catch(Exception $e) {
            Toastr::error("Sorry something went wrong!","Danger!");
            return redirect()->route('betoptions_edit',['id'=>$id]);
        }
    }

}
