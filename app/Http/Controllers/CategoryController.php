<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
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
    public function categorystore(CategoryStoreRequest $request)
{
    $data = $request->validated();

    Category::create([
        'name' => $data['name'] 
    ]);

    return redirect('categories')->with('success', "Ma'lumot muvvafaqiyatli qo'shildi");
}

    public function categoryedit(Category $category)
    {
        //dd($category);
        return view('Category.categoryupdate',['category'=>$category]);
    }
    public function categoryupdate(CategoryUpdateRequest $request, Category $category)
    {
        //dd($category);
        $data=$request->validated();
        $category->name=$data['name'];
        $category->save();
        return redirect('categories')->with('success',"Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function categorydelete(Category $category)
    {
        $category->delete();
        return redirect('categories')->with('success',"Ma'lumot muvvafaqiyatli o'chirild");
    }
}
