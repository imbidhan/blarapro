<?php

namespace App\Modules\Slide\Http\Controllers;

use App\Models\Slide\Slide;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SlideController extends Controller
{
    #Slides view
    public function index() {
        $slides = Slide::get();
        return view("slide::slides.index",compact("slides"));
    }

    #Slide create
    public function create() {
        return view("slide::slides.create");
    }
    #Slide store
    public function store(Request $request) {

        $this->validate($request,[
            "slideImage"=>"required",
        ],[
            "slideImage.required" => "Slide image is required",
        ]);

        $slides = Slide::get()->count();
        if($slides > 4){
            Toastr::error("Error! You have to create 5 slider, already 5 created.","Danger!");
            return redirect()->back();
        }

        try{
            if ($request->file('slideImage')) {

                $fileInfo = $request->file('slideImage');
                $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                $size = $fileInfo->getSize();
                $kb = $size / 1024;

                $check=in_array($imageExt,['jpg']);

                if (in_array($imageExt,['jpg']) == false) {
                    Toastr::warning("Opps! Upload only jpg format","Warning!");
                    return redirect()->route("slides_create");
                }

                if ($kb > 200) {
                    Toastr::warning("Opps! file size less then 200 KB.","Warning!");
                    return redirect()->route("slides_create");
                }

                $uniqueName = "slide_" . time() . rand() . "." . strtolower($imageExt);
                $folderName = "backend/uploads/slides/";
                $fileInfo->move($folderName, $uniqueName);
                $imageDbPath = $folderName . $uniqueName;

                $slide = new Slide();
                $slide->slideTitle    = trim(strip_tags($request->slideTitle));
                $slide->sliderContent = trim(strip_tags($request->sliderContent));
                $slide->slideBtnText  = trim(strip_tags($request->slideBtnText));
                $slide->slideBtnLink  = trim(strip_tags($request->slideBtnLink));
                $slide->slideImage    = $imageDbPath;
                $slide->created_by    = Auth::guard("admin")->user()->id;
                $slide->save();

                Toastr::success("Success! Slide create successfully.","Success!");
                return redirect()->route("slides_create");
            }
        }catch (Excception $e){
            Toastr::danger("Danger! Something want wrong!","Danger!");
            return redirect()->route("slides_create");
        }
    }

    #Slide edit
    public function edit($id) {
        $slide = Slide::find($id);
        return view('slide::slides.edit',compact('slide'));
    }

    #Slide update
    public function update(Request $request,$id) {

        $slide = Slide::find($id);
        try{

            if ($request->file('slideImage')) {

                $fileInfo = $request->file('slideImage');
                $imageExt = strtolower($fileInfo->getClientOriginalExtension());
                $size = $fileInfo->getSize();
                $kb = $size / 1024;

                if (in_array($imageExt,['jpg']) == false) {
                    Toastr::warning("Opps! Upload only jpg format","Warning!");
                    return redirect()->back();
                }

                if ($kb > 200) {
                    Toastr::warning("Opps! file size less then 200 KB.","Warning!");
                    return redirect()->back();
                }
                
                unlink($slide->slideImage);
                $uniqueName = "slide_" . time() . rand() . "." . strtolower($imageExt);
                $folderName = "backend/uploads/slides/";
                $fileInfo->move($folderName, $uniqueName);
                $imageDbPath = $folderName . $uniqueName;

            }

            $slide->slideTitle    = trim(strip_tags($request->slideTitle));
            $slide->sliderContent = trim(strip_tags($request->sliderContent));
            $slide->slideBtnText  = trim(strip_tags($request->slideBtnText));
            $slide->slideBtnLink  = trim(strip_tags($request->slideBtnLink));
            if($request->file('slideImage')){
                $slide->slideImage = $imageDbPath;
            }
            $slide->status   = $request->status;
            $slide->updated_at   = Carbon::now();
            $slide->update();

            Toastr::success("Slide updated successfully.","Success!");
            return redirect()->back();

        }catch (Excception $e){
            Toastr::danger("Danger! Something want wrong!","Danger!");
            return redirect()->back();
        }
    }

    #Slide Soft delete
    public function destroy($id) {

        $slide = Slide::find($id);
        $slide->status = 0;
        $slide->update();

        Toastr::success("Slide delete successfully.","Success!");
        return redirect()->back();
    }
}


