<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    /**
     * Switch the application's locale.
     */
    public function switch(string $locale): RedirectResponse
    {
        // Validate if the locale exists in our config
        if (! in_array($locale, config('app.locales', ['en']))) {
            $locale = config('app.fallback_locale', 'en');
        }

        // Set the application locale
        App::setLocale($locale);
        Session::put('locale', $locale);

        return redirect()->back();
    }


}
