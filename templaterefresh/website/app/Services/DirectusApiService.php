<?php

namespace App\Services;

use App\Helpers\AppHelper;
use Illuminate\Support\Arr;
use App\ViewModels\PageViewModel;
use App\ViewModels\HomePageViewModel;

class DirectusApiService
{
    /**
     * @return App\ViewModels\HomePageViewModel
     */
    public function homePage(HttpService $apiService)
    {
        // get our data for home page
        $homePage = $apiService->homePageDayclar()->getDirectusData();
        $aboutDayclar = $apiService->aboutDayclar()->getDirectusData();
        $bannerSlides = $apiService->homeSlidesDayclar()->getDirectusData(true);
        $servicesOffered = $apiService->dayclarServices()->getDirectusData(true);

        // init our view model class instance
        $homePageViewModel = new HomePageViewModel('Home', 'home');

        // set our default oage structure from cms
        $homePageViewModel->setPageData([
                'section1H' => $homePage->section_one_heading,
                'section1subH' => $homePage->section_one_sub_heading,
                'section2H' => $homePage->section_two_heading,
                'section2subH' => $homePage->section_two_sub_heading,
                'section3H' => $homePage->section_three_heading,
                'section3subH' => $homePage->section_three_sub_heading,
          ]);

        if ($homePage->use_default_section) {
            $homePageViewModel->setDefaultData($homePage->default_section_content);
        }

        // build viewModel object
        $homePageViewModel->buildDefaultViewModel();
        // add our custom data to the page
        $homePageViewModel->addToViewModel([
                'about' => AppHelper::ArrayToObject(Arr::except(AppHelper::ObjectToArray($aboutDayclar), ['id', 'created_by'])),
                'bannerSlides' => $bannerSlides,
                'servicesOffered' => $servicesOffered,
         ]);

        // final viewModel
        return $homePageViewModel;
    }

    public function contactPage(HttpService $apiService)
    {
        // refer to index for implementation comments
        $contactPage = $apiService->contactPageDayclar()->getDirectusData();
        $aboutDayclar = $apiService->aboutDayclar()->getDirectusData();

        $contactPageViewModel = new PageViewModel('Contact us', 'contact');

        $contactPageViewModel->setPageData([
                'section1H' => $contactPage->section_one_heading,
                'section1subH' => $contactPage->section_one_sub_heading,
                'section2H' => $contactPage->section_two_heading,
                'section2subH' => $contactPage->section_two_sub_heading,
                'section3H' => $contactPage->section_three_heading,
                     'section3subH' => $contactPage->section_three_sub_heading,
                     'test' => 'hdhdh',
          ]);

        if ($contactPage->use_default_section) {
            $contactPageViewModel->setDefaultData($contactPage->default_section_content);
        }

        $contactPageViewModel->buildDefaultViewModel();
        $contactPageViewModel->addToViewModel([
               'about' => AppHelper::ArrayToObject(Arr::except(AppHelper::ObjectToArray($aboutDayclar), ['id', 'created_by'])),
                'arrayType' => gettype(['test' => 'isod']),
          ]);

        return $contactPageViewModel;
	 }
	 

	 /// CODE BELOW NOT IN USE 

    /**
     * @param $payload is Array with keys that represent enquiry_id & service_id
     */
    public function updateEnquiryServicesJunction($enquiry, $services)
    {
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));

        // dd($enquiry);

        if (count($services->service_selection) > 1) {
            foreach ($services->service_selection as $service) {
                $curl->post(env('DIRECTUS_API').'items/service_enquiries?access_token='.env('DIRECTUS_AUTH_KEY'), [
                    'service' => $service,
                    'enquiry' => $enquiry->id,
                ]);

                if ($curl->error) {
                    return [
                        'junction' => false,
                        'status' => false,
                        'error' => $curl->error,
                    ];
                }
            }
        } else {
            $curl->post(env('DIRECTUS_API').'items/service_enquiries?access_token='.env('DIRECTUS_AUTH_KEY'), [
                'service' => $services->service_selection[0],
                'enquiry' => $enquiry->id,
            ]);

            if ($curl->error) {
                return [
                    'junction' => false,
                    'status' => false,
                    'error' => $curl->error,
                ];
            }
        }

        return [
            'junction' => $curl->response,
            'status' => true,
            'error' => $curl->error,
        ];
    }

    public function updateCustomerEnquiryJunction($enquiry, $customer)
    {
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));

        $curl->post(env('DIRECTUS_API').'items/enquiry_junction?access_token='.env('DIRECTUS_AUTH_KEY'), [
            'enquiry' => $enquiry->id,
            'customer' => $customer->id,
        ]);

        if ($curl->error) {
            return [
                'status' => false,
                'error' => $curl->error,
            ];
        }

        return [
            'junction' => $curl->response,
            'status' => true,
            'error' => $curl->error,
        ];
    }

    public function createEnquiry($customer, $enquiry)
    {
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));

        $curl->post(env('DIRECTUS_API').'items/enquiries?access_token='.env('DIRECTUS_AUTH_KEY'), [
            'status' => 'active',
            'email' => $customer->email,
            'subject' => $enquiry->subject,
            'message' => $enquiry->message,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($curl->error) {
            return [
                'status' => false,
                'error' => $curl->error,
            ];
        }

        return [
            'enquiry' => $curl->response,
            'status' => true,
            'error' => $curl->error,
        ];
    }

    public static function getCustomers()
    {
        $curl = new Curl();

        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
        $curl->get(env('DIRECTUS_API').'items/customers?fields=*.*.*&access_token='.env('DIRECTUS_AUTH_KEY'));

        if ($curl->error) {
            return view('error');
        } else {
            return $curl->response;
        }
    }
}
