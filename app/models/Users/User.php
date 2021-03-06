<?php

namespace Users;
use Documents\Document;
//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends \Eloquent {

    use SoftDeletingTrait;

    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $date = ['deleted_at'];
    protected $hidden = ['password'];
    protected $softDelete = true;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'username',
        'password'
    ];

/////////////////////////////////////////////////////////////////////////
    public function sessions() {
        return $this->hasMany('UserSession', 'id', 'user__id');
    }

    public function documents() {
        return $this->hasMany('Documents\Document', 'user__id', 'id');
    }

////////////////////////////////////////////////////////////////////////
    public function isCorrectPassword($password) {
        $sendPass = hash('sha512', $password);

        if ($this->password === $sendPass) {

            return true;
        } else {
            return false;
        }
    }

    public static function getWithHash($hash) {
        $session = UserSession::getSessionWithHash($hash);
        if (!$session) {
            return null;
        }
    }

}
