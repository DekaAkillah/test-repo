<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TeamUser;
use App\Models\ProgramTeam;

class Team extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function team_users(){
        return $this->hasMany(TeamUser::class);
    }

    public function program_teams(){
        return $this->hasMany(ProgramTeam::class);
    }
}
