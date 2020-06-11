<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * @method static whereId($abonent_id)
 */
class Mabonent extends Model
{
    protected $table = 'abonent';
    protected $guarded =['id'];

    function user()
    {
        return $this->belongsTo('App\User');
    }



}
