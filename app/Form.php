<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Form extends Eloquent
{

    protected $connection = 'mongodb';

    protected $collection = 'form';
    

    protected $fillable = [
        'name','form_type'
    ];
}
