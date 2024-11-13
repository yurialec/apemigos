<?php

namespace App\Http\Controllers;

use App\Traits\SiteTrait;

class SiteController extends Controller
{
    use SiteTrait;

    public function index()
    {
        $mainText = $this->mainText();
        $carousels = $this->carousels();
        $contact = $this->contactSite();
        $socialmedias = $this->socialmedias();
        $about = $this->aboutSite();
        $siteblogs = $this->siteblogs();

        return view('site', compact('mainText', 'carousels', 'contact', 'socialmedias', 'about', 'siteblogs'));
    }

    public function about()
    {
        $socialmedias = $this->socialmedias();
        $contact = $this->contactSite();
        $about = $this->aboutSite();
        return view('partials.about.index', compact('about', 'socialmedias', 'contact'));
    }

    public function contact()
    {
        $contact = $this->contactSite();
        $socialmedias = $this->socialmedias();
        return view('partials.contact.index', compact('contact', 'socialmedias'));
    }

    public function footer()
    {
        $socialmedias = $this->socialmedias();
        return view('partials.footer.index', compact('contact', 'socialmedias'));
    }
}
