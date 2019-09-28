<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use App\Services\DirectusApiService;

class PageViewer extends Controller
{
    public function index(HttpService $httpService)
    {
        $directus = new DirectusApiService();
        $homePageViewModel = $directus->homePage($httpService);
        
        dd($homePageViewModel->viewModelObject());
        // return view($homePageViewModel->templateName());
    }

    public function contact(HttpService $httpService)
    {
        $directus = new DirectusApiService();
        $contactPageViewModel = $directus->contactPage($httpService);
        
        dd($contactPageViewModel->viewModelObject());
        // return view($contactPageViewModel->templateName());
    }
}
