<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Mabonent extends Model
{
    protected $table = 'abonent';
    protected $guarded =['id'];

    function user()
    {
        return $this->belongsTo('App\User');
    }



}
