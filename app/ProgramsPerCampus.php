<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramsPerCampus extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'campus_id', 'name', 'level', 'validity', 'link'
    ];

    public function campus() {
        
        return $this->belongsTo(Campus::class);

    }
}
