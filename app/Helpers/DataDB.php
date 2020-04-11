<?php

use Illuminate\Support\Facades\DB;

/**
 * DataDB helper
 */

function period($time = null, $tz = null)
{
    return DB::table('syssana')->first('tekoy');;
}

