<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categories=Category::orderBy('id','desc')->get();
        return view('Category.category',['categories'=>$categories]);
    }
    public function categorycreate()
    {
        return view('Category.categorycreate');
    }
    public function categorystore(Request $request)
    {
        //dd($request->all());
        $data=$request->validate([
            'name'=>'required|max:255'
        ]);
        Category::create($data);
        return redirect('categories')->with('success',"Ma'lumot muvvafaqiyatli qo'shildi");
    }
    public function categoryedit(Category $category)
    {
        //dd($category);
        return view('Category.categoryupdate',['category'=>$category]);
    }
    public function categoryupdate(Request $request, Category $category)
    {
        //dd($category);
        $request->validate([
            'name'=>'required|max:255'
        ]);
        $category->name=$request->name;
        $category->save();
        return redirect('categories')->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function categorydelete(Category $category)
    {
        $category->delete();
        return redirect('categories')->with('success',"Ma'lumot muvvafaqiyatli o'chirild");
    }
}
