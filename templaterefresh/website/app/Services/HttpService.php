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
     * @POST
     */
    public function aboutDayclar()
    {
        // $this->setRequestHeaders();
        $this->internalResponse->reset();

        $request = $this->curl;
       
        try {
             $request->setHeader('Authorization', 'Bearer '.env('DIRECTUS_AUTH_KEY'));
             $str =  $this->api_url.'/about?access_token='.env('DIRECTUS_AUTH_KEY');
             
            $request->get( $str );

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $this->internalResponse->error($this->jsonResponseData());

                // error
                return $this->internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $this->internalResponse->success($this->jsonResponseData());

            // successful
            return $this->internalResponse;
        } catch (Exception $e) {
            $this->internalResponse->error($e);
        }
    }

    /**
     *  GET PAGE DATA BELOW.
     */

    /**
     * @POST
     */
    public function homePageDayclar()
    {
        // $this->setRequestHeaders();
        $this->internalResponse->reset();

        $request = $this->curl;
        try {
            $request->get(
                $this->api_url.'/pages?fields=*.*&filter[page_name]=Home'
            );

            if ($request->error && $request->http_status_code !== 200) {
                $this->updateCurlResponse($request->http_status_code, $request->response, 'api request error');

                $this->internalResponse->error($this->jsonResponseData());

                // error
                return $this->internalResponse;
            }

            $this->updateCurlResponse($request->http_status_code, $request->response);
            $this->internalResponse->success($this->jsonResponseData());

            // successful
            return $this->internalResponse;
        } catch (Exception $e) {
            $this->internalResponse->error($e);
        }
    }

    public function getReqRaw(string $url)
    {
        return $this->curl->get($url);
    }
}
