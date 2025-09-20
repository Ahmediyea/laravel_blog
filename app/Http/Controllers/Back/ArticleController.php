<?php

namespace App\Http\Controllers\Back;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles= Article::orderBy('created_at','ASC')->get(); // Fetch all articles from the database
        return view('back.articles.index', compact('articles')); // Assuming you have a view for listing articles
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all(); // Fetch all categories for the article form
        return view('back.articles.create', compact('categories')); // Assuming you have a view for creating articles
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate image upload
        ]);

        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->category;
        $article->slug= Str::slug($request->title);

 // Generate a slug from the title

        if ($request->hasFile('image')) {
            $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName); // Move the uploaded image to the public/images directory
            $article->image = 'images/'.$imageName; // Save the image name in the article
            $article->save(); // Save the article to the database
            // Display a success toast with no title
            flash()->success('Makale başarıyla oluşturuldu.',);

            return redirect()->route('admin.makaleler.index'); // Redirect to the articles index with a success message

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id); // Fetch the article by ID or fail

        $categories = \App\Models\Category::all(); // Fetch all categories for the article form
        return view('back.articles.update', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // Validate image upload
        ]);

        $article = Article::findOrFail($id); // Fetch the article by ID or fail
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->category;
        $article->slug= Str::slug($request->title);
 // Generate a slug from the title

        if ($request->hasFile('image')) {
            $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName); // Move the uploaded image to the public/images directory
            $article->image = 'images/'.$imageName;
            }
             // Save the image name in the article
        $article->save(); // Save the article to the database
        // Display a success toast with no title
        flash()->success('Makale başarıyla güncellendi.',);

        return redirect()->route('admin.makaleler.index'); // Redirect to the articles index with a success message



    }

   public function switch(Request $request)
{
    $article = Article::findOrFail($request->id);
    $article->status = $request->statu;  // direk 1 veya 0 alır
    $article->save();

    return response()->json(['success' => 'Başarıyla değiştirildi.']);
}

    public function delete($id)
    {
        Article::find($id)->delete();
        flash()->success('Makale silinmiş makaleler kısmına taşındı.',);

        return redirect()->route('admin.makaleler.index');


    }


    public function trashed()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at','DESC')->get(); // Fetch only soft-deleted articles
        return view('back.articles.trashed', compact('articles')); // Assuming you have a view for trashed article

    }

    public function recover($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        flash()->success('Makale başarıyla geri yüklendi.',);

        return redirect()->route('admin.makaleler.trashed');

    }


    public function hardDelete($id)
    {
        $article=Article::onlyTrashed()->findOrFail($id);
        if (File::exists($article->image)) {
            File::delete(public_path($article->image)); // Delete the image file from the public/images directory
        }
         // Save the image name in the article

        $article->forceDelete();
         // Permanently delete the article from the database
        flash()->success('Makale başarıyla silindi.',);

        return redirect()->route('admin.makaleler.index');


    }

/**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

}
