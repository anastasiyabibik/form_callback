<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'question',
        'files'
    ];
}