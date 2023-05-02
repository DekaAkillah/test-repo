<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Team;

class TeamUser extends Model
{
    use HasFactory;

    protected $table = 'team_user';
    protected $fillable = [
        'team_id',
        'user_id',
    ];
    public $timestamps = false;

    public function team(){
        return $this->belongsTo(Team::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
