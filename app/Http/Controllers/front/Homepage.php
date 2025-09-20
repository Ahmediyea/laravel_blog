<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;

class Homepage extends Controller
{
    public function __construct(){
        if(Config::find(1)->active==0){
             redirect()->to('site-bakımda')->send();
    }

        view()->share('pages',$pages = Page::where('status', 1)->orderBy('order','asc')->get());
        view()->share('categories',$categories = Category::where('status',1)->get());
    }
    public function index()
    {
        $articles = Article::with('getCategory')->orderByRaw("id=2 DESC")->where('status',1)->whereHas('getCategory',function($query){
        $query->where('status',1);
        })->orderBy('created_at', 'DESC')->paginate(10);






        return view('front.homepage', compact('articles'));
    }

    public function single($category,$slug)
{
    // slug sayıysa id’den, değilse slug’tan çek
    $article = Article::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    Category::whereSlug($category)->first() ?? abort(403,"NO");
    $data['article']=$article;

    $article->increment('hit');
    $pages = Page::orderBy('order','asc')->get();
    return view('front.single', compact('article'));
      // ← ikisini de gönder
}

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, "Kategori bulunamadı.");

        $articles = Article::where('category_id', $category->id)->where('status',1)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(1);
        $categories = Category::where('status',1)->get();
        $pages = Page::orderBy('order','asc')->get();
        return view('front.category', compact('category', 'articles', 'categories'));
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403, 'Sayfa bulunamadı.');
        $pages = Page::orderBy('order','asc')->where('status',1)->get();

        return view('front.page', compact('page', 'pages'));
    }

    public function contact(){

        return view('front.contact');
    }
    public function contactpost(Request $request){
        $rules = [
            'name' => 'required|string|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:10'
        ];

        $validate = Validator::make($request->post(), $rules);

        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

    







    $contact= new Contact;
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->topic=$request->topic;
    $contact->message=$request->message;
    $contact->save();


    return redirect()->route('contact')->with('success','İletişim mesajınız iletildi');


    }

}



