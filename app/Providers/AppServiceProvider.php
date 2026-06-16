<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Filament\Facades\Filament;

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
        // Menerjemahkan menu blog dari plugin vendor secara paksa berdasarkan bahasa aktif
        Filament::serving(function () {
            $locale = App::getLocale();

            if ($locale === 'ja') {
                // Terjemahan Bahasa Jepang
                config([
                    'filament-blog.navigation.group' => 'ブログ',
                    'filament-blog.navigation.category.label' => 'カテゴリー',
                    'filament-blog.navigation.tag.label' => 'タグ',
                    'filament-blog.navigation.post.label' => '投稿',
                    'filament-blog.navigation.seo.label' => 'SEO詳細',
                    'filament-blog.navigation.comment.label' => 'コメント',
                    'filament-blog.navigation.newsletter.label' => 'ニュースレター',
                    'filament-blog.navigation.share.label' => 'スニペット共有',
                    'filament-blog.navigation.setting.label' => '設定',
                ]);
            } elseif ($locale === 'en') {
                // Terjemahan Bahasa Inggris
                config([
                    'filament-blog.navigation.group' => 'Blog',
                    'filament-blog.navigation.category.label' => 'Category',
                    'filament-blog.navigation.tag.label' => 'Tag',
                    'filament-blog.navigation.post.label' => 'Post',
                    'filament-blog.navigation.seo.label' => 'SEO Details',
                    'filament-blog.navigation.comment.label' => 'Comment',
                    'filament-blog.navigation.newsletter.label' => 'Newsletter',
                    'filament-blog.navigation.share.label' => 'Share Snippet',
                    'filament-blog.navigation.setting.label' => 'Setting',
                ]);
            }
        });
    }
}