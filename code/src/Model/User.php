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

    }//end rolexs(


}//end class
