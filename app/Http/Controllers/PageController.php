<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show about page.
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show contact page.
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Show privacy policy page.
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Show terms of service page.
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Show FAQ page.
     */
    public function faq()
    {
        return view('pages.faq');
    }

    /**
     * Show disclaimer page.
     */
    public function disclaimer()
    {
        return view('pages.disclaimer');
    }
}
