<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index()
 {
        $categories = Category::all();
        return view('admin.home.category',compact('categories'));
 }

 public function storeCategory(Request $request)
{        

    $validatedData = $request->validate([
        'name' => 'required|string',
        'slug' => 'required|unique:categories,slug',
        'description' => 'nullable|unique:categories,description',
        ]);

        Category::create([
            'name' => $validatedData['name'],
            'slug'=> $validatedData['slug'],
            'description' => $validatedData['description'],
        ]);

    return redirect()->back()->with('success','Category has been added successfully !');
}

public function updateCategory(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:categories,slug,',
        'description' => 'nullable|unique:categories,description'
    ]);

    $update = Category::find($request->category_id);
    $update->name = $validatedData['name'];
    $update->slug = $validatedData['slug'];
    $update->description = $validatedData['description'];
          
    $update->save();    
    return redirect()->back()->with('success','Category has been updated successfully !');
}

public function deleteCategory($id)
{
    $category = Category::find($id);
    $category->delete();
    return redirect()->back()->with('success','Category has been deleted successfully !');
}
}
