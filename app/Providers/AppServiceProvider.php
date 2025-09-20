<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Config;
use App\Models\Contact;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    // Tüm view'lara $config değişkenini gönder
    view()->share('config', Config::find(1));

    // Route resource isimlerini Türkçeleştir
    Route::resourceVerbs([
        'create' => 'oluştur',
        'edit' => 'düzenle',
    ]);

    // back.layouts.menu view'una $contacts değişkenini gönder
    View::composer('back.layouts.menu', function ($view) {
        $contacts = Contact::all(); // tüm kayıtlar
        $view->with('contacts', $contacts);
    });
 }
}
