<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\TemporaryFile;
use App\Models\TeamUser;
use App\Models\Program;
use App\Models\ProgramTeam;
use Illuminate\Support\Facades\DB;
use File;
use Storage;

class CompetitionController extends Controller
{
    public function show($slug) {
        $program = Program::where('slug', $slug)->firstOrFail();

        return view('competition.show', [
            'title' => $program->name,
            'program' => $program
        ]);
    }

    public function createTeam($slug){
        $currentDateTime = Carbon::now();
        $program = Program::where('slug', $slug)->first();

        if($currentDateTime >= $program->stage_1_open_registration && $currentDateTime <= $program->stage_1_close_registration){
            if($slug == 'poster-2022'){
                return $this->storePosterParticipant($program);
            }else{
                return view('competition.create-team', [
                    'title' => 'Create Team',
                    'program' => $program 
                ]);
            }
        }else{
            return redirect()->back();
        }
    }

    public function storePosterParticipant($program){
        DB::beginTransaction();
        try {
            $programTeam = ProgramTeam::create([
                'program_id' => $program->id,
                'user_id' => auth()->user()->id,
            ]);
            DB::commit();

            return redirect()->route('dashboard.show-team', [
                'competitionSlug' => $program->slug,
                'team_code' => $programTeam->user_id,
            ])->with('success', 'Data telah berhasil ditambahkan.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal disimpan. ');
        }
    }

    public function storeTeam(Request $request, $slug){
        $this->validate($request,[
            'name' => 'required',
            'code' => 'required|unique:teams',
        ]);

        $currentDateTime = Carbon::now();
        $program = Program::where('slug', $slug)->first();

        if($currentDateTime >= $program->stage_1_open_registration && $currentDateTime <= $program->stage_1_close_registration){
            DB::beginTransaction();
            try {
                $team = Team::create([
                    'name'=> $request->name,
                    'institution'=> $request->institution,
                    'major'=> $request->major,
                    'code'=> strtoupper($request->code),
                    'leader_id'=> auth()->user()->id
                ]);

                $file = $request->logo;
                $temporaryFile = TemporaryFile::where('folder', $file)->first();

                if($temporaryFile){
                    $file_name = 'Logo - ' . $request->name . '.' .$temporaryFile->extension;
                    $sourcePath = 'public/logo/tmp/' . $file . '/' .$temporaryFile->file_name;
                    $destinationPath = 'public/' . $request->code . '/' .$file_name;
                    $storage = Storage::move($sourcePath, $destinationPath);
                    
                    $team->update([
                        'logo' => $request->code . '/' .$file_name
                    ]);

                    $temporaryFile->delete();
                }

                $programTeam = ProgramTeam::create([
                    'program_id' => $program->id,
                    'team_id' => $team->id,
                ]);

                DB::commit();
                
                return redirect()->route('competition.asassemble-member', [
                    'slug' => $program->slug,
                    'teamCode' => $team->code,
                    ])->with('success', 'Team berhasil dibuat');
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->back()->with('error', 'Team gagal dibuat. ' . $th->getMessage());
            } 
        }else{
            return redirect()->back();
        }  

    }

    public function joinTeam($slug){
        $currentDateTime = Carbon::now();
        $program = Program::where('slug', $slug)->first();

        if($currentDateTime >= $program->stage_1_open_registration && $currentDateTime <= $program->stage_1_close_registration){
            return view('competition.join-team', [
                'title' => 'Join Existing Team',
                'program' => $program 
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function joinTeamResult(Request $request, $slug){
        $found = false;
        $isAvailable = false;
        $totalMember = 0;
        $available = 0; 
        $programTeam = null;

        $currentDateTime = Carbon::now();
        $program = Program::where('slug', $slug)->first();

        if($currentDateTime >= $program->stage_1_open_registration && $currentDateTime <= $program->stage_1_close_registration){
            $team = Team::where('code', $request->code)->first();

            if($team){
                $teamUser = TeamUser::where('team_id', $team->id)->get();
                $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
                $totalMember = count($teamUser);
                $found = true;
                $available = $program->max_team - $totalMember;
            }

            return view('competition.join-team-result', [
                'title' => 'Join Team One',
                'team' => $team,
                'found' => $found,
                'totalMember' => $totalMember,
                'available' => $available,
                'programTeam' => $programTeam,
                'slug' => $slug,
                'isAvailable' => $available == 0 ? false : true,
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function participantJoinTeam(Request $request){
        $teamUser = TeamUser::create([
            'user_id' => auth()->user()->id,
            'team_id' => $request->teamId,
        ]);

        return redirect()->route('dashboard.index');
    }

    public function assembleMember($slug, $code){
        $program = Program::where('slug', $slug)->first();
        $team = Team::where('code', $code)->first();

        if($team->leader_id != auth()->user()->id){
            return redirect('/dashboard');
        }

        $members = TeamUser::where('team_id', $team->id)->get();

        return view('competition.assemble-team-member', [
            'title' => 'Assemble Member For ' . $team['name'],
            'team' => $team,
            'program' => $program,
            'members' => $members
        ]);
    }

    
}
