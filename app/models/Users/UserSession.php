<?php

namespace Users;

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
    protected $table = 'users_session';
    protected $fillable = [
        'userId',
        'hash',
        'start_at',
        'finish_at'
    ];

    public static function createWithUser($user) {
        $param = [
            'userId' => $user->id,
            'start_at' => date('Y-m-d H:i:s'),
            'finish_at' => date('Y-m-d H:i:s', strtotime('+5 minute')),
            'hash' => self::generateHash(date('Y-m-d H:i:s'))
        ];
        $session = self::create($param);
        return $session;
    }

    private static function generateHash($loggedAt) {
        return hash('sha512', $loggedAt);
    }

    public static function getSessionWithHash($hash) {
        return self::where('hash', '=', $hash)
                        ->where('start_at', '<=', date('Y-m-d H:i:s'))
                        ->where('finish_at', '>=', date('Y-m-d H:i:s'))
                        ->first();
    }

    public function lenghtenSession() {
        $this->finish_at = date('Y-m-d H:i:s', strtotime('+5 minute'));
        $this->save();
    }

    public function user() {
        return $this->belongsTo('User', 'userId', 'userId');
    }

}
