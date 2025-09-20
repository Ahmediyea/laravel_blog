<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    public function index(){
        $pages = Page::orderBy('order', 'asc')->where('status',1)->get();
        return view('back.pages.index', compact('pages'));

    }

public function create(){

    $pages = Page::all();
    return view('back.pages.create',compact('pages'));

}

public function store(Request $request){
    $request->validate([
        'title' => 'required|min:3',
        'content' => 'required|min:10',

    ]);
    $count = Page::count();

    $page = new Page();
    $page->title = $request->input('title');
    $page->content = $request->input('content');
    $page->slug= Str::slug($request->title);
    $page->status= 1;
    $page->order = $count+1;



 // Generate a slug from the title

    if ($request->hasFile('image')) {
        $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName); // Move the uploaded image to the public/images directory
        $page->image = 'images/'.$imageName; // Save the image name in the article
        $page->save(); // Save the article to the database
        // Display a success toast with no title
        flash()->success('Sayfa başarıyla oluşturuldu.',);

        return redirect()->route('admin.page.index'); // Redirect to the articles index with a success message

    }
}



public function switch(Request $request)
{
    $page = Page::findOrFail($request->id);
    $page->status = $request->statu;  // direk 1 veya 0 alır
    $page->save();

    return response()->json(['success' => 'Başarıyla değiştirildi.']);

}

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10',

        ]);

        $page = Page::findOrFail($id);

         if ($request->hasFile('image')) {
            $imageName= Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName); // Move the uploaded image to the public/images directory
            $page->image = 'images/'.$imageName;
            }
        $page->title = $request->input('title');
        $page->content = $request->input('content');
        $page->save();

        flash()->success('Sayfa başarıyla güncellendi.');
        return redirect()->route('admin.page.index');
    }

    public function delete($id)
    {
        $page=Page::findOrFail($id);
        if (File::exists($page->image)) {
            File::delete(public_path($page->image)); // Delete the image file from the public/images directory
        }
         // Save the image name in the Page

        $page->forceDelete();
         // Permanently delete the Page from the database
        flash()->success('Sayfa başarıyla silindi.',);

        return redirect()->route('admin.makaleler.index');


    }

    public function orders(Request $request){

        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key ]);


        }

    }

}
