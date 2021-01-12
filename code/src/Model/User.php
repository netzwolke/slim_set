<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Valitron\Validator;

class User extends Model
{

    protected $guarded = [];

    public $timestamps;



    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }//end role

    public function setPassword($validate)
    {
        if(isset($validate['password']))
        {
            $password = $validate['password'];
            $password= password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);

        }
        return $password;
    }

    public function validate(array $validate)
    {
        $v = new Validator($validate);
        $v->rule('required','name');
        if($v->validate())
        {

            return true;
        } else {
            return false;
        }
    }
}//end class
