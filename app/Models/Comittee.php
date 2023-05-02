<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Comittee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nim',
        'name',
        'email',
        'password',
        'section',
        'position',
        'telephone',
        'avatar',
        'is_active',
    ];

    protected $hidden = ['password',  'remember_token'];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
