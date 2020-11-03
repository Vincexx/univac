<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'name', 'description', 'image', 'image_path', 'certificate'
    ];

    public function programs() {
        
        return $this->hasMany(ProgramsPerCampus::class);

    }
}
