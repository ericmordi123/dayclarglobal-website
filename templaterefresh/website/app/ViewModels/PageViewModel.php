<?php

namespace App\ViewModels;

class PageViewModel
{
    public $name = 'Dayclar';
    public $templateName;

    public $section1H;
    public $section1subH;

    public $section2H;
    public $section2subH;

    public $section3H;
    public $section3subH;

    public $useDefaultSection = false;
    public $defaultSection = null;

    public $viewModel = [];

    public function __construct(String $name = null, String $templateName = null, String $section1H = null, String $section1subH = null, String $section2H = null, String $section2subH = null, String $section3H = null, String $section3subH = null)
    {
        $this->name = $name;
        $this->templateName = $templateName;
        $this->section1H = $section1H;
        $this->section1subH = $section1subH;
        $this->section2H = $section2H;
        $this->section2subH = $section2subH;
        $this->section3H = $section3H;
        $this->section3subH = $section3subH;
    }

    public function getSectionOneData()
    {
        return $this->section1;
    }

    public function viewModelObject()
    {
        return $this->viewModel;
    }

    public function setPageData($data)
    {
        foreach ($data as $key => $info) {
            if (!empty($info)) {
                $this->$key = $info;
            }
        }
    }

    public function setDefaultData($sectionData)
    {
        $this->useDefaultSection = true;
        $this->defaultSection = $sectionData;
    }

    public function buildDefaultViewModel()
    {
        $this->viewModel = [
            'sectionOneHeading' => $this->section1H,
            'sectionOneSubHeading' => $this->section1subH,
            'sectionTwoHeading' => $this->section2H,
            'sectionTwoSubHeading' => $this->section2subH,
            'sectionThreeHeading' => $this->section3H,
            'sectionThreeSubHeading' => $this->section3subH,
        ];

        if ($this->useDefaultSection) {
            $this->viewModel['defaultSectionData'] = $this->defaultSection;
        }

        return $this;
    }
}
