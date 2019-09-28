<?php

namespace App\ViewModels;

use Illuminate\Support\Arr;

class HomePageViewModel extends PageViewModel
{
    public function addToViewModel(Array $data)
    {
		  $this->viewModel = array_merge($this->viewModel, $data);
    }

    public function templateName()
    {
		 return $this->templateName;
    }
}
