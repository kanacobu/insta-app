<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category=$category;
    }

    public function index()
    {
        
        $all_categories = $this->category->latest()->get();
        return view('admin.categories.index')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
       $request->validate([
        'name'=>'required|min:1|max:50'
       ]);

       $this->category->name=$request->name;
    
       
       $this->category->save();
       return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|min:1|max:50'
        ]);

        $category = $this->category->findOrFail($id);
        $category->name = $request->name;

        $category->save();

        return redirect()->route('admin.categories');
        
    }
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories');
    }
}
