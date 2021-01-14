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

    public function makePassword($password = null)
    {
        if($password != null){
            {
                $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
                return true;
            }
        }
        return false;

    }
    public static function create(array $attributes)
    {
        $user = new self();
        $user->fill($attributes);
        $user->save();

    }



    public function fill(array $attributes): User
    {
        if(isset($attributes['password']) && $attributes != '')
        {
            $this->makePassword($attributes['password']);
        }
        unset($attributes['password']);
        return parent::fill($attributes);
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
