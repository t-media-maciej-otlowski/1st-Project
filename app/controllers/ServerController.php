<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ServerController extends Controller {
    
    public $moduleParams = array(
        'moduleId' => 0,
        'moduleCode' => '000'
    );
    
    /**
     * Returns json-able response array with correct parameters
     * @param mixed $message
     * @param string $status
     * @param string $error
     * @return array
     */
     public function responseJson($message, $status = 'success', $error = null) {
        return json_encode([
            'status' => $status,
            'message' => $message,
            'error' => $error
        ]);
    }
    
}