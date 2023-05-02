<?php

namespace App\Http\Controllers\api;

use App\Models\TemporaryFile;
use App\Models\User;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamUserApiController extends Controller
{
    public function storeLogo(Request $request){
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/logo/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function findMember($email){
        $user = User::where('email', $email)
                ->where('is_complete', 1)
                ->where('is_active', 1)->first();
        
        return collect($user); 
    }
    
    public function addMember(Request $request){
        $userTeam = TeamUser::where('team_id',$request->teamId)->where('user_id', $request->userId)->first();

        if($request->teamLeaderId != $request->userId && $userTeam == null){
            $teamUser = TeamUser::create([
                'user_id' => $request->userId,
                'team_id' => $request->teamId,
            ]);
        }
        else{
            $teamUser = '';
        }
        return $teamUser;
    }

    public function removeMember(User $user){}
}
