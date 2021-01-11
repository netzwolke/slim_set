<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Model
{

    protected $guarded = [];

    public $timestamps;


    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }//end role

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>12]);
        return $this->password;
    }


}//end class
