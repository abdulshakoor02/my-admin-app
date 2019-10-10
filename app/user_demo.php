<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_demo extends Model
{
    //
    protected $dateFormat = 'Y-m-d H:i:s.u';

    protected $table = 'user_demo';

    protected $fillable = [
        'username','password'
    ];
}
