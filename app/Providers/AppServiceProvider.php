<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Firefly\FilamentBlog\Resources\PostResource;
use Firefly\FilamentBlog\Resources\CategoryResource;
use Firefly\FilamentBlog\Resources\CommentResource;
use Firefly\FilamentBlog\Resources\NewsletterResource;
use Firefly\FilamentBlog\Resources\TagResource;
use Firefly\FilamentBlog\Resources\SettingResource;
use Firefly\FilamentBlog\Resources\SeoDetailResource;
use Firefly\FilamentBlog\Resources\ShareSnippetResource;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $blogResources = [
            PostResource::class,
            CategoryResource::class,
            CommentResource::class,
            NewsletterResource::class,
            TagResource::class,
            SettingResource::class,
            SeoDetailResource::class,
            ShareSnippetResource::class,
        ];

        foreach ($blogResources as $resource) {
            $resource::macro('canViewAny', function () {
                return auth()->user()?->hasRole('Admin');
            });
        }
    }
}