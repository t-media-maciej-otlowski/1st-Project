<?php
namespace Documents;
namespace Users;

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
    protected $fillable = array
        (
        'name',
        'surname',
        'username',
        'password'
    );

    public function isCorrectPassword($password) {
        $sendPass = hash('sha512', $password);

        if ($this->password === $sendPass) {

            return true;
        } else {
            return false;
        }
    }

    public function sessions() {
        return $this->hasMany('UserSession', 'userId', 'userId');
    }

    public static function getWithHash($hash) {
        $session = UserSession::getSessionWithHash($hash);
        if (!$session) {
            return null;
        }
    }

    public function ownDocument() {
        return $this->hasMany('DocumentAttributes', 'userId', 'userId');
    }

}
