<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //
    public function Index(){
        return view('admin.home.slider');
    }

    public function storeslider(Request $request){
        $validatedData = $request->validate([
        'heading' => 'required|string',
        'sub_heading'=> 'required|string|max:255',
        'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',// max 2mb
        'more_info_link' => 'nullable|url',
        ]);

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('slides','public');
        }

        Slider::create([
            'heading' => $validatedData['heading'],
            'sub_heading'=> $validatedData['sub_heading'],
            'image_link' => $imagePath,
            'more_info_link' => $validatedData['more_info_link'],
        ]);

        return redirect()->back()->with('success','Slide added successfully!');

    }
}
