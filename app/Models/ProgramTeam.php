<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Program;
use App\Models\ProgramTheme;
use App\Models\Team;
use App\Models\User;

class ProgramTeam extends Model
{
    use  Notifiable;

    protected $table = 'program_team';
    protected $primaryKey = null;
    public $incrementing = false;
    
    protected $fillable = [
        'program_id',
        'team_id',
        'user_id',
        'program_theme_id',
        'file_stage_1',
        'file_stage_2',
        'file_stage_3',
        'proposal',
        'originality',
        'result_link',
        'presentation',
        'twibbon',
        'payment_proof',
        'is_paid',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function program_theme()
    {
        return $this->belongsTo(ProgramTheme::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
