<?php

namespace App\Http\Controllers;

use App\Services\HttpService;
use App\Services\ViewModelBuilder;

class PageViewer extends Controller
{
    public function index(HttpService $httpService)
    {
        $homePageViewModel = ViewModelBuilder::homePage($httpService);
        dd($homePageViewModel->viewModelObject());
        return view($homePageViewModel->templateName())
                    ->withPageModel($homePageViewModel->viewModelObject())
                    ->withAbout($homePageViewModel->viewModelObject()->about);
    }

    public function contact(HttpService $httpService)
    {
        $contactPageViewModel = ViewModelBuilder::contactPage($httpService);
        return view($contactPageViewModel->templateName())
                    ->withPageModel($contactPageViewModel->viewModelObject())
                    ->withAbout($contactPageViewModel->viewModelObject()->about);
    }
}