<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comittee;
use App\Models\ProgramTeam;
use App\Models\User;
use App\Models\Team;

class Program extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function comittee(){
        return $this->belongsTo(Comittee::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function program_themes(){
        return $this->hasMany(ProgramTheme::class);
    }

    public function program_teams()
    {
        return $this->hasMany(ProgramTeam::class);
    }
}
