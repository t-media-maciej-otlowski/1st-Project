<?php

namespace Users;

use Documents\Document;

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

// 
// 1.
// $users = User::all();
// foreach($users as $index => &$user) {
//    $user->documents;
// } 
// 2.
// $usersWithDocs = User::where(1)->with('documents')->get();
   
    
    
    
    


    /*
      public function showDocument() {
      try {
      $document = Documents::withTrashed()->where('confirmed', 0);
      } catch (\Exception $ex) {

      }
      }
     */

    public function doLogin() {

        try {

            $input = \Input::all();
            $validate = \Validator::make($input, array(
                        'username' => 'required|min:5',
                        'password' => 'required|min:4'
            ));


            if ($validate->fails()) {
                return self::responseJson($validate->errors(), 'error', '1walidacjaZle');
            }


            $user = User::withTrashed()->where('username', '=', $input['username'])->first();


            // chech deleted_at

            if (!$user) {
                return self::responseJson('No user found', 'error', '2222');
            }
            if (!empty($user->deleted_at)) {
                return self::responseJson('User deleted', 'error', '2223');
            }

            if (!$user->isCorrectPassword($input['password'])) {
                return self::responseJson('Incorrect password', 'error', null);
            }

            $session = UserSession::createWithUser($user);
//            $session->save();

            $user->sessions = [$session];
            $message = array(
                'user' => $user,
            );

            return self::responseJson($message);
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', 'cos poszlo nie tak' . '-0000');
        }
    }

    public function isLogged() {
        try {
            $input = \Input::all();

            $validator = \Validator::make($input, [
                        'hash' => 'required|max:255'
            ]);
            if ($validator->fails()) {
                return self::responseJson($validator->errors(), 'error', '');
            }

            $session = UserSession::getSessionWithHash($input['hash']);
            if (!$session) {
                return self::responseJson('Session not found', 'error', '....');
            }
            $user = $session->user;
            if (!$user) {
                return self::responseJson('User not found', 'error', '696969');
            }
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', 'blad hashu', '000000');
        }
    }

    public function doLogout() {

        try {
            $hash = \Input::get('hash');
            if (empty($hash)) {
                return self::responseJson('Session hash not found', 'error', '-100');
            }
            $session = \UserSession::getSessionWithHash($hash);
            $user = $session->user;

            if (!$user) {
                return self::responseJson('user not found', 'error', '-200');
            }
            $session->finish_at = date('Y-m-d H:i:s');
            $session->save();
            $session->delete();
            return self::responseJson('Zalogowany', '', '');
        } catch (\Exception $ex) {
            return self::responseJson($ex->getMessage(), 'error', '500', '500');
        }
    }

}
