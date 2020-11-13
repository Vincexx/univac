<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherDocument extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name', 'file' 
    ];
}
