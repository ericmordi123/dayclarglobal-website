<?php

namespace App\Services;

use App\ViewModels\HomePageViewModel;

class DirectusApiService
{
    /**
     * @return App\ViewModels\HomePageViewModel
     */
    public function homePage(HttpService $apiService)
    {
        $homePageData = $apiService->homePageDayclar();
        $aboutDayclar = $apiService->aboutDayclar();

		  $homePageViewModel = new HomePageViewModel('Home', 'home');
		  
		  $homePageViewModel->setPageData([
				"section1H" => '',
				"section1subH" => '',
				"section2H" => '',
				"section2subH" => '',
				"section3H" => '',
				"section3subH" => '',
		  ]);

		  if (false) {
				$homePageViewModel->setDefaultData(['']);
		  }

		  $homePageViewModel->buildDefaultViewModel();
		  $homePageViewModel->addToViewModel([
			  "about" => $aboutDayclar,
			  "pageData" => $homePageData
			]);

		  return $homePageViewModel;
    }

    public function createCustomer($customer)
    {
        $curl = new Curl();
        // $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));

        $curl->post(env('DIRECTUS_API').'items/customers?access_token='.env('DIRECTUS_AUTH_KEY'), [
            'first_name' => $customer['first_name'],
            'email' => $customer['email'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if ($curl->error) {
            return [
                'status' => false,
                'error' => $curl->error,
            ];
        }

        return [
            'customer' => $curl->response,
            'status' => true,
            'error' => $curl->error,
        ];
    }

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

    /**
     * gets site generic data.
     */
    public function siteData($fields = false)
    {
        $curl = new Curl();
        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));

        // return env('DIRECTUS_API').'items/generic_site_data?fields='.$fields."&access_token=".env('DIRECTUS_AUTH_KEY');
        // return $fields;

        // return requested fields only
        if ($fields) {
            $curl->get(env('DIRECTUS_API').'items/generic_site_data?fields='.$fields.'&access_token='.env('DIRECTUS_AUTH_KEY'));

            if ($curl->error) {
                // return view('error');
                return [
                    'status' => $curl->error,
                    'url' => env('DIRECTUS_API').'items/generic_site_data?fields='.$fields.'&access_token='.env('DIRECTUS_AUTH_KEY'),
                ];
            } else {
                return $curl->response;
            }
        }

        // return all fields
        $curl->get(env('DIRECTUS_API').'items/generic_site_data?fields=*.*,services.service.*,skills.skill.*,social_platforms.social_platform.*,my_testimonials.testimonial.*.*&access_token='.env('DIRECTUS_AUTH_KEY'));

        if ($curl->error) {
            return view('error');
        } else {
            return $curl->response;
        }
    }

    public function projects()
    {
        $curl = new Curl();

        // $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
        $curl->get(env('DIRECTUS_API').'items/projects?status=published&fields=*.*,tech_used.tech.*,gallery.file.*&access_token='.env('DIRECTUS_AUTH_KEY'));

        if ($curl->error) {
            return view('error');
        } else {
            return $curl->response;
        }
    }

    public function getProject($slug)
    {
        $curl = new Curl();

        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
        $curl->get(env('DIRECTUS_API').'items/projects?filter[project_slug][eq]='.$slug.'&fields=*.*,tech_used.tech.*,gallery.file.*&access_token='.env('DIRECTUS_AUTH_KEY'));

        if ($curl->error) {
            return view('error');
        } else {
            return $curl->response;
        }
    }

    public function getService($slug)
    {
        $curl = new Curl();

        $curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
        $curl->get(env('DIRECTUS_API').'items/services?filter[slug][eq]='.$slug.'&fields=*.*,tech.tech.*,related_images.file.*,related_projects.project.*.*.*&access_token='.env('DIRECTUS_AUTH_KEY'));

        if ($curl->error) {
            return view('error');
        } else {
            return $curl->response;
        }
    }
}
