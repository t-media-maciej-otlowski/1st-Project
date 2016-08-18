    <?php


//Route::get('document', function() {
//    return View::make('document');
//});


Route::get('documents', array('uses' => 'Documents\DocumentsController@showDocuments'));
Route::get('documentsing', array('uses' => 'Documents\DocumentsController@showDocumentsInChoosenGroup'));
Route::get('document2', array('uses' => 'Documents\DocumentsController@showAttributes'));

Route::group(array('prefix' => 'api'), function() {



    Route::post('login', array('uses' => 'Users\UsersController@doLogin'));

    //Route::post('login', array('uses' => 'Users\UsersController@showDocument'));
    
    Route::post('islogin', array('uses' => 'Users\UsersController@isLogged'));

    Route::post('logout', array('uses' => 'Users\UsersController@doLogout'));
});
