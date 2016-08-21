<?php

namespace ApiClient;

class ApiClientTestController extends \Controller {

    public function showForm() {
        return \View::make('ApiClientTest.index');
    }
    
    
    public function sendData() {
        $method = \Input::get('method');
        $url = \Input::get('url');
        $json = \Input::get('json');
        $global = \Input::get('global');
        return $this->sendRequest($method, $url, $json, $global);
    }

    private function sendRequest($method, $url, $feed = '', $global) {
        
        $url = \Config::get('apiClient.serverUrl') . $url;
        
        $response = null;
        $feedString = null;
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_URL, $url);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            if ($feed) {
                $feedArray = json_decode($feed,true);
                $feedString = http_build_query($feedArray);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $feedString);
            }
        }
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'API-Key: ' . \Config::get('apiClient.publicKey'), 'Content-Length: ' . (!$feedString ? '0' : strlen($feedString))));
        //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml' , 'Accept: application/json' ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        return $response;
    }

}
