<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'payment_test';
    protected $primaryKey = 'external_id';
    protected $keyType = 'string';

    public $incrementing = false;
    
}
