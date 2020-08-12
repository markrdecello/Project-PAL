<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answers extends Eloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'answers';
    

    protected $fillable = [
        'question_id', 'submitted_id', 'answer'
    ];
}
