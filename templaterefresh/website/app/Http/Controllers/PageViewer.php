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
        
        dd($homePageViewModel);
    }
}
