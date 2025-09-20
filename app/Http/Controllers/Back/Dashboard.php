<?php

namespace App\Http\Controllers\Back;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Page;
class Dashboard extends Controller
{
    public function index(){
        $article=Article::all()->count();
        $category=Category::all()->count();
        $page=Page::all()->count();
        $hit=Article::sum('hit');
        $categories=Category::all();
        $articles = Article::with('getCategory')->orderByRaw("id=2 DESC")->where('status',1)->whereHas('getCategory',function($query){
        $query->where('status',1);
        })->orderBy('created_at', 'DESC')->paginate(1);
        $pages = Page::orderBy('order','asc')->where('status',1)->get();
        return view('back.dashboard',compact('article','category','page','hit','categories','articles','pages'));
    }

    // ProfileController.php
    public function profile() {
        $user = Auth::user(); // Giriş yapan kullanıcı
        return view('back.profil', compact('user'));
}

}
