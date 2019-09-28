<?php

namespace App\ViewModels;

use Illuminate\Support\Arr;

class HomePageViewModel extends PageViewModel
{
    public function templateName()
    {
		 return $this->templateName;
    }
}
