<?php

namespace App\Traits;

use App\Models\Blog\Blog;
use App\Models\Site\MainText;
use App\Models\Site\SiteAbout;
use App\Models\Site\SiteCarousel;
use App\Models\Site\SiteContact;
use App\Models\Site\SiteSocialMedia;

trait SiteTrait
{
    public function mainText()
    {
        return MainText::first();
    }

    public function carousels()
    {
        return SiteCarousel::get();
    }

    public function contactSite()
    {
        return SiteContact::first();
    }

    public function socialmedias()
    {
        return SiteSocialMedia::get();
    }

    public function aboutSite()
    {
        return SiteAbout::first();
    }

    public function blogs()
    {
        return Blog::orderBy('id', 'DESC')->get();
    }

    public function blogById($id)
    {
        return Blog::find($id);
    }

    public function siteblogs()
    {
        return Blog::orderBy('id', 'DESC')->take(3)->get();
    }
}
