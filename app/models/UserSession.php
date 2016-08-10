<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserSession extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    protected $primaryKey = 'userSessionId';
    protected $table = 'users_sessions';
    protected $fillable = [
        'userId',
        'hash',
        'isMobile',
        'userAgent',
        'ipAdress',
        'isForwarded'
    ];

    public static function createWithUser($user) {
        $session = self::create([
                    'userId' => $user->userId,
                    'start_at' => date('Y-m-d H:i:s'),
                    'finish_at' => date('Y-m-d H:i:s', strtotime(\Config::get('app_users.sessionExpirationTime'))),
                    'hash' => self::generateHash($user->email, date('Y-m-d H:i:s'))
        ]);
        return $session;
    }

    private static function generateHash($userEmail, $loggedAt) {
        return hash('sha512', $userEmail, $loggedAt);
    }

    public static function getSessionWithHash($hash) {
        return self::where('hash', '=', $hash)
                        ->where('start_at', '<=', date('Y-m-d H:i:s'))
                        ->where('finish_at', '>=', date('Y-m-d H:i:s'))
                        ->first();
    }

    public function lenghtenSession() {
        $this->finish_at = date('Y-m-d H:i:s', strtotime(\Config::get('app_users.sessionExpirationTime')));
        $this->save();
    }

    public function user() {
        return $this->belongsTo('User', 'userId', 'userId');
    }

}
