<?php

namespace Users;

class UsersController extends \ServerController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function doLogin() {
        
        try {

            $input = \Input::all();
            $validate = \Validator::make($input, array(
                        'username' => 'required|min:5',
                        'password' => 'required|min:4'
            ));
            
            if ($validate->fails()) {
                return self::responseJson($validate->errors(), 'error', '0001000');
            }
            

            $user = \User::withTrashed()->where('username', '=', $input['username'])->first();
            
            
            // chech deleted_at
            
            
            if (!$user) {
                return self::responseJson('No user found', 'error', '2222');
            }
            
            if ( !empty($user->deleted_at) ) {
                return self::responseJson('User deleted', 'error', '2223');
            }

            if ( $user->isCorrectPassword($input['password'])) {
                dd('pass');
                $message = array(
                    'user' => $user . '123',
                );

                return self::responseJson($message);
            }
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', $this->moduleParams['moduleCode'] . '-0000');
        }
    }

    public function isLogged() {
        return self::responseJson('Zalogowany', '', '');
    }

    public function doLogout() {
        return self::responseJson('Wylogowany', '', '');
    }

}
