<?php

//Route::get('documentsing', array('uses' => 'Documents\DocumentsController@showDocumentsInChoosenGroup'));
//Route::get('document2', array('uses' => 'Documents\DocumentsController@showAttributes'));
//

/* App :: API Test enviroment (Test client) */
Route::group(['namespace' => 'ApiClient', 'prefix' => 'developers'], function() {
    Route::get('/info', function() {
        phpinfo();
        die();
    });
    Route::get('/api', ['uses' => 'ApiClientTestController@showForm']);
    Route::post('/api/send', ['uses' => 'ApiClientTestController@sendData']);
});

/* 
 * App 
 */

/* App Web */

/* App RESTful API */


// Module :: DOCUMENTS
    Route::group(array('prefix' => 'documents'), function() {
        
        Route::post('showdoc', array('uses' => 'Documents\DocumentsController@showDocuments'));
        Route::get('showgroup', array('uses' => 'Documents\DocumentsController@showDocumentsInChoosenGroup'));
        Route::get('showall', array('uses' => 'Documents\DocumentsController@showAll'));
        
        Route::post('list', array('uses' => 'Documents\DocumentsController@listDocuments'));
        Route::post('add', array('uses' => 'Documents\DocumentsController@addDocuments'));
        Route::post('update', array('uses' => 'Documents\DocumentsController@updateDocuments'));
        Route::post('delete', array('uses' => 'Documents\DocumentsController@deleteDocuments'));
        
    });


// Module :: Users
Route::group(array('prefix' => 'users'), function() {
    Route::post('login', array('uses' => 'Users\UsersController@doLogin'));
});
