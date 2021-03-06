<?php

namespace App\ViewModels;

use App\Helpers\AppHelper;

class PageViewModel
{
    public $name = 'Dayclar';
    public $templateName;

    public $section1H;
    public $section1subH;
    public $section1img = null;

    public $section2H;
    public $section2subH;
    public $section2img = null;

    public $section3H;
    public $section3subH;
    public $section3img = null;

    public $useDefaultSection = false;
    public $defaultSection = null;

    public $viewModel = [];

    public function __construct(String $name = null, String $templateName = null)
    {
        $this->name = $name;
        $this->templateName = $templateName;
    }

    public function getSectionOneData()
    {
        return $this->section1;
    }

    public function viewModelObject()
    {
        return AppHelper::ArrayToObject($this->viewModel);
    }

    public function setPageData($data)
    {
        foreach ($data as $key => $info) {
            if (!empty($info)) {
                $this->$key = $info;
            }
        }
    }

    public function templateName()
    {
		 return $this->templateName;
    }

    public function setDefaultData($sectionData)
    {
        $this->useDefaultSection = true;
        $this->defaultSection = $sectionData;
    }

    public function addToViewModel(array $data)
    {
        $this->viewModel = array_merge($this->viewModel, $data);
    }

    public function buildDefaultViewModel()
    {
        $this->viewModel = [
            'baseUrl'=> env('DIRECTUS_ADMIN'),
            'name'=> $this->name,
            'sectionOneHeading' => $this->section1H,
            'sectionOneSubHeading' => $this->section1subH,
            'sectionOneBgImg' => $this->section1img,
            'sectionTwoHeading' => $this->section2H,
            'sectionTwoSubHeading' => $this->section2subH,
            'sectionTwoBgImg' => $this->section2img,
            'sectionThreeHeading' => $this->section3H,
            'sectionThreeSubHeading' => $this->section3subH,
            'sectionThreeBgImg' => $this->section3img,

        ];

        if ($this->useDefaultSection) {
            $this->viewModel['defaultSectionData'] = $this->defaultSection;
        }

        return $this;
    }
}
