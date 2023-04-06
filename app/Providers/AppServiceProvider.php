<?php

namespace App\Providers;

use App\Modules\ImageUpload\ImageManagerInterface;
use App\Modules\ImageUpload\LocalImageManager;
use Illuminate\Support\ServiceProvider;
use Cloudinary\Cloudinary;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Cloudinary::class, function () {
            return new Cloudinary([
                'cloud'=>[
                    'cloud_name'=>config('cloudinary.cloud_name'),
                    'api_key'=>config('cloudinary.api_key'),
                    'api_secret'=>config('cloudinary.api_secret')
                ]
            ]);
        });
        if($this->app->environment('production')){
            $this->app->bind(ImageManagerInterface::class, CloudinaryImageManager::class);
        }else{
            $this->app->bind(ImageManagerInterface::class, LocalImageManager::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}