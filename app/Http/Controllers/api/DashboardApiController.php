<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\TeamUser;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardApiController extends Controller
{
    public function addMember(User $user){}

    public function removeMember(User $user){}
}
