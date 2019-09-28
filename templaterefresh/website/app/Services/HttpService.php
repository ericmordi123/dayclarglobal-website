<?php

namespace App\Services;

use Curl\Curl;
use App\Enums\ResponseTypes;

class HttpService
{
    private $curl;
    private $base_url;
    private $api_url;
    private $internalResponse;

    private $curl_response = [
        'code' => '',
        'message' => '',
        'data' => null,
    ];

    /**
     * @param base_url begins with "/"
     * @param api_url begins with "/"
     */
    public function __construct()
    {
        $this->base_url = env('DIRECTUS_API_DEV');
        $this->api_url = env('DIRECTUS_API_DEV');
        $this->internalResponse = new InternalResponseService(ResponseTypes::INTERNAL());
    }

    // mutations

    // computed

    // getters

    public function config()
    {
        $this->curl = new Curl();
    }

    public function getBase()
    {
        return $this->base_url;
    }

    public function getApi()
    {
        return $this->api_url;
    }

    public function jsonResponse()
    {
        return $this->curl_response;
    }

    public function jsonResponseData($parse = false)
    {
        if ($parse) {
            return json_decode($this->curl_response['data']);
        }

        return $this->curl_response['data'];
    }

    public function setRequestHeaders()
    {
        $this->curl->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
    }

    public function responseCode()
    {
        return $this->curl_response['code'];
    }

    public function responseMessage()
    {
        return $this->curl_response['message'] ? $this->curl_response['message'] : 'message empty';
    }

    public function addResponseData($data)
    {
        $this->curl_response['data'] = $data;
    }

    private function updateCurlResponse($code, $data, $message = null)
    {
        $this->curl_response['code'] = $code;
        $this->curl_response['data'] = $data;
        $this->curl_response['message'] = $message;

        return $this;
    }

    /**
     * @GET
     */
    public function aboutDayclar()
    {
        $this->setRequestHeaders();

        $internalResponse = new InternalResponseService();
        $request = $this->curl;

        try {
            $request->get($this->api_url.'/about');

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $internalResponse->error($this->jsonResponseData());

                // error
                return $internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $internalResponse->success($this->jsonResponseData(true));

            // successful
            return $internalResponse;
        } catch (Exception $e) {
            $internalResponse->error($this->jsonResponseData($e));
        }
    }

      /**
     * @GET
     */
    public function homeSlidesDayclar()
    {
        $this->setRequestHeaders();

        $internalResponse = new InternalResponseService();
        $request = $this->curl;

        try {
            $request->get($this->api_url.'/banner_slides?fields=*.*&status=published');

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $internalResponse->error($this->jsonResponseData());

                // error state
                return $internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $internalResponse->success($this->jsonResponseData(true));

            // successful state
            return $internalResponse;
        } catch (Exception $e) {
            $internalResponse->error($this->jsonResponseData($e));
        }
    }


      /**
     * @GET
     */
    public function dayclarServices()
    {
        $this->setRequestHeaders();

        $internalResponse = new InternalResponseService();
        $request = $this->curl;

        try {
            $request->get($this->api_url.'/services_offered?fields=*&status=published');

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $internalResponse->error($this->jsonResponseData());

                // error state
                return $internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $internalResponse->success($this->jsonResponseData(true));

            // successful state
            return $internalResponse;
        } catch (Exception $e) {
            $internalResponse->error($this->jsonResponseData($e));
        }
    }

    /**
     *  GET PAGE DATA BELOW.
     */

    /**
     * @GET
     */
    public function homePageDayclar()
    {
        $this->setRequestHeaders();

        $internalResponse = new InternalResponseService();
        $request = $this->curl;

        try {
            $request->get(
                $this->api_url.'/site_pages?fields=*.*&filter[page_name]=Home'
            );

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $internalResponse->error($this->jsonResponseData());

                // error
                return $internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $internalResponse->success($this->jsonResponseData(true));

            // successful
            return $internalResponse;
        } catch (Exception $e) {
            $internalResponse->error($this->jsonResponseData($e));
        }
    }

    /**
     * @GET
     */
    public function contactPageDayclar()
    {
        $this->setRequestHeaders();
        $internalResponse = new InternalResponseService();
        $request = $this->curl;

        try {
            $request->get(
                $this->api_url.'/site_pages?fields=*.*&filter[page_name]=Contact'
            );

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $internalResponse->error($this->jsonResponseData());

                // error
                return $internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $internalResponse->success($this->jsonResponseData(true));

            // successful
            return $internalResponse;
        } catch (Exception $e) {
            $internalResponse->error($this->jsonResponseData($e));
        }
    }
}
