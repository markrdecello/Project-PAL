<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Submitted extends Eloquent
{
    protected $connection = 'mongodb';
    
    protected $collection = 'submitted';

    protected $fillable = [
        'user_id','form_id','status'
    ];
}
