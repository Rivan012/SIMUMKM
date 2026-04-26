<?php

namespace App\Providers;
use App\Models\Sistem\WebConfig;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));

        if (\Schema::hasTable('web_configs') && WebConfig::count() == 0) {
            WebConfig::create([
                'name' => 'SIMUMKM',
                'judul' => 'SIMUMKM - Sistem Informasi Manajemen UMKM',
                'logo' => 'default-logo.png',
                'phone' => '081234567890',
                'address' => 'Jl. Contoh Alamat No. 123, Kota Contoh',
                'description' => 'Sistem Informasi Manajemen UMKM untuk membantu pengelolaan data UMKM dengan mudah dan efisien.',
                'hero_image' => 'default-hero.jpg',
                'social_media' => json_encode([
                    'facebook' => 'https://www.facebook.com/simumkm',
                    'twitter' => 'https://www.twitter.com/simumkm',
                    'instagram' => 'https://www.instagram.com/simumkm',
                ]),
            ]);
        }
        // Mengirim data 'webConfig' ke SEMUA view
        View::composer('*', function ($view) {
            $view->with('webConfig', \App\Models\Sistem\WebConfig::first());
        });
    }
}
