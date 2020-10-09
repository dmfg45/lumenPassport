<?php

namespace App\Traits;
use GuzzleHttp\Client;

trait ConsumesExternalService
{

    /**
     * Send a Request to any service
     * @return string
     */

     public function performRequest($method, $resquestUrl, $formParams = [], $headers = [])
     {

        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $resquestUrl, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
     }

}