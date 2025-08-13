<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function Index(){

        $sliders = Slider::all();

        return view('admin.home.slider',compact('sliders'));
        
    }

    public function storeslider(Request $request){
        $validatedData = $request->validate([
        'heading' => 'required|string',
        'sub_heading'=> 'required|string|max:255',
        'btn_name' => 'required|string|max:15',
        'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',// max 3mb
        'more_info_link' => 'nullable|url',
        ]);

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('slides','public');
        }

        Slider::create([
            'heading' => $validatedData['heading'],
            'sub_heading'=> $validatedData['sub_heading'],
            'btn_name' => $validatedData['btn_name'],
            'image_link' => $imagePath,
            'more_info_link' => $validatedData['more_info_link'],
        ]);

        return redirect()->back()->with('success','Slide added successfully!');

    }

    public function updateslider(Request $request){
        $validatedData = $request->validate([
        'heading' => 'required|string',
        'sub_heading' => 'required|string|max:255',
        'btn_name' => 'required|string|max:15',
        'more_info_link' => 'nullable|url',
        ]);

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('slides','public');
        }

        $update = Slider::find($request->slider_id);
        $update->heading = $validatedData['heading'];
        $update->sub_heading = $validatedData['sub_heading'];
        $update->btn_name = $validatedData['btn_name'];

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('slides', 'public');
            $update->image_link = $imagePath;
        }

        $update->more_info_link = $validatedData['more_info_link'];

        $update->save();

        return redirect()->back()->with('success','Slide updated successfully!');

    }

 
    public function deleteslider($id){
        $delete = Slider::find($id);
        
            $delete->delete();

        return redirect()->back()->with('success','Slide deleted successfully!');

    }

    
}
