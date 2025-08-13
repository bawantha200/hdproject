<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    //
    public function Index(){ 

        $galleries = Gallery::all();
        return view('admin.home.gallery',compact('galleries'));
    }

    public function storegallery(Request $request){
        $validatedData = $request->validate([
        'title' => 'required|string',
        'description'=> 'required|string|max:255',
        'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',// max 3mb
        ]);

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('gallery','public');
        }

        Gallery::create([
            'title' => $validatedData['title'],
            'description'=> $validatedData['description'],
            'image_link' => $imagePath,
        ]);

        return redirect()->back()->with('success','Image added successfully!');

    }

    public function updategallery(Request $request){
        $validatedData = $request->validate([
        'title' => 'required|string',
        'description' => 'required|string|max:255',
        ]);

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('gallery','public');
        }

        $update = Gallery::find($request->gallery_id);
        $update->title = $validatedData['title'];
        $update->description = $validatedData['description'];

        if($request->hasFile('image_upload')){
            $imagePath = $request->file('image_upload')->store('gallery', 'public');
            $update->image_link = $imagePath;
        }

        $update->save();

        return redirect()->back()->with('success','Image updated successfully!');

    }


    public function deletegallery($id){
        $delete = Gallery::find($id);
        
            $delete->delete();

        return redirect()->back()->with('success','Image deleted successfully!');

    }

    
}
