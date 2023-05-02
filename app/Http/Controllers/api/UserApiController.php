<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserApiController extends Controller
{
    public function show(User $user){
        return $user;
    }

    public function update(Request $request){
        return 'success';
    }

    public function updateAvatar(Request $request){
        return 'success';
    }
}
