<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\Models\ProgramTheme;

class ProgramTheme extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comittee(){
        return $this->belongsTo(Program::class);
    }

    public function program_themes(){
        return $this->hasMany(ProgramTheme::class);
    }
}
