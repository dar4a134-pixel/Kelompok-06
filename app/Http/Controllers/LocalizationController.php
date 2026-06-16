<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function __invoke(string $locale): RedirectResponse
    {
        if (in_array($locale, ['id', 'en', 'ja'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}