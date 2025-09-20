<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function  index(){
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function  switch(Request $request){


        $category = Category::findOrFail($request->id);
        $category->status = $request->statu ;  // direk 1 veya 0 alır
        $category->save();




     }

    public function create(Request $request){


        $isExists = Category::whereSlug(Str::slug($request->category))->first();
        if($isExists){
            // Hata mesajı
            flash()->error('Bu kategori zaten mevcut.');
            return redirect()->back();
        }

        $request->validate([
            'category' => 'required|min:3|max:20|unique:categories,name'
        ]);

        $category = new Category();
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();

        // Başarılı mesajı
        flash()->success('Kategori başarıyla oluşturuldu.');
        return redirect()->back();

    }

    public function getData(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function delete(Request $request){

        $category = Category::findOrFail($request->id);
        if($category->id == 1){
            // Hata mesajı
            flash()->error('Bu kategori silinemez.');
            return redirect()->back();
        }
        $count=$category->articleCount();
        if ($count>0){
            $defaultCategory = Category::find(1);
            // Kategoriye ait makaleler varsa 1. kategoriye aktar
            \App\Models\Article::where('category_id', $category->id)->update(['category_id' => $defaultCategory->id]);
            flash()->success('Bu kategoriye ait ' .$count. ' makale '.$defaultCategory->name.' kategorisine taşındı.');

        }


        $category->delete();
        // Başarılı mesajı
        flash()->success('Kategori başarıyla silindi.');
        return redirect()->back();

    }

    public function update(Request $request){


        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName = Category::whereName($request->category)->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName){
            // Hata mesajı
            flash()->error('Bu kategori zaten mevcut.');
            return redirect()->back();
        }



        $category = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = $request->slug;
        $category->save();

        // Başarılı mesajı
        flash()->success('Kategori başarıyla güncellendi.');
        return redirect()->back();

    }


}
