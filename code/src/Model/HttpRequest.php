<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class HttpRequest extends Model
{
    protected $table = 'httpRequests';
    protected $guarded = [];
    protected $casts = [
        'options' => 'array'
    ];
}