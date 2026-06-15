<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictBlogAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $blogRoutes = [
            'admin/posts',
            'admin/categories',
            'admin/comments',
            'admin/newsletters',
            'admin/tags',
            'admin/settings',
            'admin/seo-details',
            'admin/share-snippets',
        ];

        foreach ($blogRoutes as $route) {
            $isCreate = $request->is($route . '/create');
            $isEdit   = $request->is($route . '/*/edit');
            $isDelete = $request->isMethod('DELETE');

            if ($isCreate || $isEdit || $isDelete) {
                if (!auth()->user()?->hasRole('Admin')) {
                    abort(403, 'Akses ditolak.');
                }
            }
        }

        return $next($request);
    }
}