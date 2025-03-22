<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{

    public function list()
    {

        return Inertia::render('Admin/Language/List');
    }


    public function create()
    {
        return Inertia::render('Admin/Language/Create');
    }

    public function edit($id)
    {
        return Inertia::render('Admin/Language/Edit', ['id' => $id]);
    }

    public function store(Request $request)
    {
        return Inertia::render('Admin/Language/Store', ['request' => $request]);
    }

    public function update(Request $request, $id)
    {
        return Inertia::render('Admin/Language/Update', ['request' => $request, 'id' => $id]);
    }


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
