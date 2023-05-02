<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use Storage;
use Hash;

use App\Models\TeamUser;
use App\Models\Team;
use App\Models\User;
use App\Models\Program;
use App\Models\ProgramTeam;
use App\Models\Announcement;
use App\Models\TemporaryFile;

use App\Http\Requests\BiodataRequest;

class DashboardController extends Controller
{
    public function index() {
        $userId = auth()->user()->id;

        $competitionsJoined = [];

        $user = User::findOrFail($userId);
        $programMemberTeam = TeamUser::where('user_id', $userId)->get();
        $programLeaderTeam = Team::where('leader_id', $userId)->get();
        $programIndividual = ProgramTeam::where('user_id', $userId)->get();

        foreach ($programMemberTeam as $key => $value) {
            foreach ($value->team->program_teams as $key => $value) {
                if($value->stage_1_status == 'checking'){
                    $stage = 'stage 1';
                }
                if($value->stage_1_status == 'eliminated'){
                    $stage = 'eliminated';
                }
                if($value->stage_1_status == 'passed'){
                    $stage = 'stage 2';
                }
                array_push($competitionsJoined, [
                    'competition' => [
                        'slug' => $value->program->slug,
                        'title' => $value->program->name,
                        'is_group' => $value->program->is_group,
                    ],
                    'team' => [
                        'code' => $value->team->code,
                        'name' => $value->team->name,
                    ],
                    'stage' => [
                        'title' => $stage,
                        'todos' => $this->getTeamStage($value->program, $value->team, $value)['todos']
                    ]
                    ]);
            }
        }

        foreach ($programLeaderTeam as $key => $value) {
            foreach ($value->program_teams as $key => $value) {
                if($value->stage_1_status == 'checking'){
                    $stage = 'stage 1';
                }
                if($value->stage_1_status == 'eliminated'){
                    $stage = 'eliminated';
                }
                if($value->stage_1_status == 'passed'){
                    $stage = 'stage 2';
                }
                array_push($competitionsJoined, [
                    'competition' => [
                        'slug' => $value->program->slug,
                        'title' => $value->program->name,
                        'is_group' => $value->program->is_group,
                    ],
                    'team' => [
                        'code' => $value->team->code,
                        'name' => $value->team->name,
                    ],
                    'stage' => [
                        'title' => $stage,
                        'todos' => $this->getTeamStage($value->program, $value->team, $value)['todos']
                    ]
                    ]);
            }
        }

        foreach ($programIndividual as $key => $value) {
            if($value->stage_1_status == 'checking'){
                $stage = 'stage 1';
            }
            if($value->stage_1_status == 'eliminated'){
                $stage = 'eliminated';
            }
            if($value->stage_1_status == 'passed'){
                $stage = 'stage 2';
            }
            array_push($competitionsJoined, [
                'competition' => [
                    'slug' => $value->program->slug,
                    'title' => $value->program->name,
                    'is_group' => $value->program->is_group,
                ],
                'team' => [
                    'code' => $value->team_id != null ? $value->team->code : $value->user->id,
                    'name' => $value->team_id != null ? $value->team->name : $value->user->name,
                ],
                'stage' => [
                    'title' => $stage,
                    'todos' => $this->getTeamStage($value->program, $value->user, $value)['todos']
                ]
                ]);
        }

        $competitionUIUX = Program::where('slug', 'ui-ux-2022')->first();
        $competitionDigitalAnimation = Program::where('slug', 'animasi-digital-2022')->first();
        $competitionBPC = Program::where('slug', 'bpc-2022')->first();
        $competitionPoster = Program::where('slug', 'poster-2022')->first();

        $currentDateTime = Carbon::now();
        $announcements = Announcement::where('datetime', '<=', $currentDateTime)->take(4)->get();

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'user' => $user,
            'announcements' => $announcements,
            'competitionsJoined' => $competitionsJoined,
            'competitionUIUX' => $competitionUIUX,
            'competitionDigitalAnimation' => $competitionDigitalAnimation,
            'competitionBPC' => $competitionBPC,
            'competitionPoster' => $competitionPoster,
        ]);
    }

    public function editProfile() {
        $user = auth()->user();
        return view('dashboard.edit-profile', [
            'title' => 'Edit Profile',
            'user' => $user
        ]);
    }

    public function changePassword() {
        return view('dashboard.change-password', [
            'title' => 'Change Password'
        ]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Password lama yang dimasukkan tidak sesuai.');
        }

        $user->password = Hash::make($request->password);
        $user->update();

        return back()->with('success', 'Password berhasil diperbarui!');

    }

    public function updateProfile(BiodataRequest $request){

        // dd($request->all());

        DB::beginTransaction();

        try {
            $user = auth()->user();
            $user->number_id = $request->number_id;
            $user->telephone = $request->telephone;
            $user->birthplace = $request->birthplace;
            $user->date_of_birth = $request->date_of_birth;
            $user->city = $request->city;
            $user->province = $request->province;
            $user->class_major = $request->class_major;
            $user->class_year = $request->class_year;
            $user->institution = $request->institution;
            $user->instagram_username = $request->instagram_username;
            $user->is_complete = 1;

            $user->update();

            if($request->hasFile('avatar')){
                $file=$request->file('avatar');
                $fileName = $file->getClientOriginalName();
                $folder = $user->id .'/images';
                $extension = $file->getClientOriginalExtension();
                $file->storeAs('public/users/'. $folder, $fileName);

                $user->update(['avatar' => 'users/'. $folder . '/' .$fileName]);
            }

            DB::commit();

            if(request()->has('competition')){
                return redirect()->route('competition.show', ['slug' => request()->query('competition')])->with('success', 'Biodata telah berhasil diperbarui');
            }else{
                return redirect()->back()->with('success', 'Biodata telah berhasil diperbarui');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Biodata gagal diperbarui' . $th->getMessage());
        }


    }

    public function showTeam($competitionSlug, $teamCode) {
        $userId = auth()->user()->id;
        $todos = [];

        $program = Program::where('slug', $competitionSlug)->firstOrFail();

        if($program->is_group){
            $participant = Team::where('code', $teamCode)->firstOrFail();
            $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $participant->id)->firstOrFail();
            $checkLeader = $participant->leader_id == $userId;
            $checkTeam = count(\DB::table('team_user')->where('user_id', $userId)->where('team_id', $participant->id)->get());
            if($checkLeader == false && $checkTeam == 0){
                return redirect('/dashboard');
            };

        }

        if($program->is_individual){
            $participant = User::findOrFail($teamCode);
            $programTeam = ProgramTeam::where('program_id', $program->id)->where('user_id', $participant->id)->firstOrFail();
            // dd($programTeam);
        }

        $stage = $this->getTeamStage($program, $participant, $programTeam);

        $competition = [
            'slug' => $program->slug,
            'is_group' => $program->is_group,
            'title' => $program->name,
            'guidebook_link' => $program->guidebook_link,
            'group_link' => $program->group_link,
            'cp_name' => $program->comittee->name,
            'cp_telp' => $program->comittee->telephone,
            'price' => $program->price,
            'is_paid' => $programTeam->is_paid,
            'stage_1_open_registration' => $program->stage_1_open_registration,
            'stage_1_close_registration' => $program->stage_1_close_registration,
            'stage_2_open_registration' => $program->stage_2_open_registration,
            'stage_2_close_registration' => $program->stage_2_close_registration,
            'payment_proof' => $programTeam->payment_proof,
            'team' => [
                'logo' => $program->is_group ? $programTeam->team->logo : $participant->avatar,
                'name' => $participant->name,
                'code' => $program->is_group ? $participant->code : $participant->id,
                'member' => count($participant->team_users),
                'leader_id' => $program->is_group ? $participant->user->id : $programTeam->user->id,
                'leader_name' => $program->is_group ? $participant->user->name : $programTeam->user->name,
                'leader_avatar' => $program->is_group ? $participant->user->avatar : $programTeam->user->avatar,
                'leader_class_major' => $program->is_group ? $participant->user->class_major : $programTeam->user->class_major,
                'leader_institution' => $program->is_group ? $participant->user->institution : $programTeam->user->institution,
                'member_account' => $program->is_group ? $participant->team_users : null
            ],
            'program_team' => $programTeam,
            'stage' => $stage,
            'year' => '2022'
        ];
        // return response()->json($competition);
        return view('dashboard.show-team.index', [
            'title' => $programTeam['name'] ?? $participant->name,
            'competition' => $competition
        ]);
    }

    public function editTeam($competitionSlug, $teamCode) {
        $program = Program::where('slug', $competitionSlug)->first();
        $team = Team::where('code', $teamCode)->first();
        $members = TeamUser::where('team_id', $team->id)->get();

        if($team->leader_id != auth()->user()->id){
            return redirect('/dashboard');
        }

        return view('dashboard.show-team.edit-team', [
            'title' => 'Configure ' . $team->name,
            'team' => $team,
            'program' => $program,
            'members' => $members
        ]);
    }

    public function updateTeam(Request $request, $competitionSlug, $teamCode){
        $this->validate($request,[
            'name' => 'required'
        ]);

        $team = Team::where('code', $teamCode)->first();

        DB::beginTransaction();

        try {
            $team->update([
                'name' => $request->name,
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
            DB::commit();
            return redirect()->back()->with('success','Team telah berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error','Team gagal diperbarui.');
            //throw $th;
        }


    }

    public function storePayment(Request $request, $slug, $code){

        DB::beginTransaction();

        try {
            $program = Program::where('slug', $slug)->first();
            $team = Team::where('code', $code)->first();

            $file = $request->payment_proof;
            $temporaryFile = TemporaryFile::where('folder', $file)->first();

            if($slug == 'poster-2022'){
                $programTeam = ProgramTeam::where('program_id', $program->id)->where('user_id', $code)->first();
            }else{
                $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
            }

            if($slug == 'animasi-digital-2022'){
                $file_name = 'Pembayaran_' . $team->user->name . '_' . $team->institution . '.' .$temporaryFile->extension;
            };

            if($slug == 'bpc-2022'){
                $file_name = $team->name . '_' . $team->institution . '_Bukti Pembayaran BPC' . '.' .$temporaryFile->extension;
            };

            if($slug == 'ui-ux-2022'){
                $file_name = $team->name . '_' . $team->institution . '_Bukti Pembayaran' . '.' .$temporaryFile->extension;
            };

            if($slug == 'poster-2022'){
                $file_name = 'LOMBA POSTER INFOGRAFIS INSPACE 2022_' . $programTeam->user->name . '_' . $programTeam->user->institution . '_BUKTI PEMBAYARAN' . '.' .$temporaryFile->extension;
            };

            if($temporaryFile){
                $sourcePath = 'public/payments/tmp/' . $file . '/' .$temporaryFile->file_name;
                $destinationPath = 'public/' .$slug . '/' . $code . '/' .$file_name;
                $storage = Storage::move($sourcePath, $destinationPath);

                if($slug == 'poster-2022'){
                    \DB::table('program_team')->where('program_id', $program->id)->where('user_id', $code)->update([
                        'payment_proof' => $slug . '/' . $code . '/' .$file_name
                    ]);
                }else{
                    \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                        'payment_proof' => $slug . '/' . $code . '/' .$file_name
                    ]);
                }

                $temporaryFile->delete();
            }
            DB::commit();
            return redirect()->back()->with('success','Bukti pembayaran telah berhasil diunggah.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error','Bukti pembayaran gagal diunggah. Silahkan coba lagi.');
        }


    }

    public function stageOne(Request $request, $slug, $code){
        $program = Program::where('slug', $slug)->first();
        $team = Team::where('code', $code)->first();

        DB::beginTransaction();

        try {
            if($slug == 'animasi-digital-2022'){
                $store = $this->storeDigitalAnimationStageOne($request, $program, $team);
            }
            if($slug == 'bpc-2022'){
                $store = $this->storeBPCStageOne($request, $program, $team);
            }

            if($slug == 'ui-ux-2022'){
                $store = $this->storeUiUxStageOne($request, $program, $team);
            }

            if($slug == 'poster-2022'){
                $store = $this->storePosterStageOne($request, $program);
            }

            DB::commit();
            return redirect()->back()->with('success','Data berhasil diunggah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error','Data gagal diunggah' . $th->getMessage());
        }

    }

    public function storeDigitalAnimationStageOne($request, $program, $team){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
        $fileStage1 = $request->file_stage_1;
        $fileReport = $request->report;

        $fileStage1TemporaryFile = TemporaryFile::where('folder', $fileStage1)->first();
        $reportTemporaryFile = TemporaryFile::where('folder', $fileReport)->first();

        $fileStage1FileName = 'Animasi Digital INSPACE 2022_' . $team->user->name . '_' . $team->institution . '.' .$fileStage1TemporaryFile->extension;
        $reportFileName = 'LSPOK_Animasi Digital_' . $team->user->name . '_' . $team->institution . '.' .$reportTemporaryFile->extension;

        if($fileStage1TemporaryFile){
            $fileStage1SourcePath = 'public/file_stage_1/tmp/' . $fileStage1 . '/' .$fileStage1TemporaryFile->file_name;
            $fileStage1DestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$fileStage1FileName;
            $fileStage1Storage = Storage::move($fileStage1SourcePath, $fileStage1DestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'file_stage_1' => $program->slug . '/' . $team->code . '/' .$fileStage1FileName
            ]);

            $fileStage1TemporaryFile->delete();
        }

        if($reportTemporaryFile){
            $reportSourcePath = 'public/report/tmp/' . $fileReport . '/' .$reportTemporaryFile->file_name;
            $reportDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$reportFileName;
            $reportStorage = Storage::move($reportSourcePath, $reportDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'report' => $program->slug . '/' . $team->code . '/' .$reportFileName
            ]);

            $reportTemporaryFile->delete();
        }

        \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
            'result_link' => $request->result_link
        ]);
    }

    public function storeBPCStageOne($request, $program, $team){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
        $fileStage1 = $request->file_stage_1;
        $fileDocument = $request->document;

        $fileStage1TemporaryFile = TemporaryFile::where('folder', $fileStage1)->first();
        $documentTemporaryFile = TemporaryFile::where('folder', $fileDocument)->first();

        if($fileStage1TemporaryFile){
            $fileStage1FileName =  $team->name . '_' . $team->institution . '_Berkas Pendaftaran' . '.' .$fileStage1TemporaryFile->extension;
            $fileStage1SourcePath = 'public/file_stage_1/tmp/' . $fileStage1 . '/' .$fileStage1TemporaryFile->file_name;
            $fileStage1DestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$fileStage1FileName;
            $fileStage1Storage = Storage::move($fileStage1SourcePath, $fileStage1DestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'file_stage_1' => $program->slug . '/' . $team->code . '/' .$fileStage1FileName
            ]);

            $fileStage1TemporaryFile->delete();
        }

        if($documentTemporaryFile){
            $documentFileName = $team->name . '_' . $team->institution . '_BMC' . '.' .$documentTemporaryFile->extension;
            $documentSourcePath = 'public/document/tmp/' . $fileDocument . '/' .$documentTemporaryFile->file_name;
            $documentDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$documentFileName;
            $documentStorage = Storage::move($documentSourcePath, $documentDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'document' => $program->slug . '/' . $team->code . '/' .$documentFileName
            ]);

            $documentTemporaryFile->delete();
        }

    }

    public function storeUiUxStageOne($request, $program, $team){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
        $fileStage1 = $request->file_stage_1;
        $fileProposal = $request->proposal;

        $fileStage1TemporaryFile = TemporaryFile::where('folder', $fileStage1)->first();
        $proposalTemporaryFile = TemporaryFile::where('folder', $fileProposal)->first();

        $fileStage1FileName = $team->name . '_' . $team->institution . '_Berkas Persyaratan' . '.' .$fileStage1TemporaryFile->extension;
        $proposalFileName = $team->name . '_' . $team->institution . '_Proposal' .'.' .$proposalTemporaryFile->extension;

        if($fileStage1TemporaryFile){
            $fileStage1SourcePath = 'public/file_stage_1/tmp/' . $fileStage1 . '/' .$fileStage1TemporaryFile->file_name;
            $fileStage1DestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$fileStage1FileName;
            $fileStage1Storage = Storage::move($fileStage1SourcePath, $fileStage1DestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'file_stage_1' => $program->slug . '/' . $team->code . '/' .$fileStage1FileName
            ]);

            $fileStage1TemporaryFile->delete();
        }

        if($proposalTemporaryFile){
            $proposalSourcePath = 'public/proposal/tmp/' . $fileProposal . '/' .$proposalTemporaryFile->file_name;
            $proposalDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$proposalFileName;
            $proposalStorage = Storage::move($proposalSourcePath, $proposalDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'proposal' => $program->slug . '/' . $team->code . '/' .$proposalFileName
            ]);

            $proposalTemporaryFile->delete();
        }

    }

    public function storePosterStageOne($request, $program){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('user_id', auth()->user()->id)->first();
        $fileStage1 = $request->file_stage_1;
        $fileDocument = $request->document;

        $fileStage1TemporaryFile = TemporaryFile::where('folder', $fileStage1)->first();
        $documentTemporaryFile = TemporaryFile::where('folder', $fileDocument)->first();

        $fileStage1FileName = auth()->user()->name . '_' . auth()->user()->institution . '_Berkas Persyaratan' . '.' .$fileStage1TemporaryFile->extension;
        $documentFileName = auth()->user()->name . '_' . auth()->user()->institution . '_Poster' .'.' .$documentTemporaryFile->extension;

        if($fileStage1TemporaryFile){
            $fileStage1SourcePath = 'public/file_stage_1/tmp/' . $fileStage1 . '/' .$fileStage1TemporaryFile->file_name;
            $fileStage1DestinationPath = 'public/' . $program->slug . '/' . auth()->user()->id . '/' .$fileStage1FileName;
            $fileStage1Storage = Storage::move($fileStage1SourcePath, $fileStage1DestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('user_id', auth()->user()->id)->update([
                'file_stage_1' => $program->slug . '/' . auth()->user()->id . '/' .$fileStage1FileName
            ]);

            $fileStage1TemporaryFile->delete();
        }

        if($documentTemporaryFile){
            $documentSourcePath = 'public/document/tmp/' . $fileDocument . '/' .$documentTemporaryFile->file_name;
            $documentDestinationPath = 'public/' . $program->slug . '/' . auth()->user()->id . '/' .$documentFileName;
            $documentStorage = Storage::move($documentSourcePath, $documentDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('user_id', auth()->user()->id)->update([
                'document' => $program->slug . '/' . auth()->user()->id . '/' .$documentFileName
            ]);

            $documentTemporaryFile->delete();
        }

    }

    public function stageTwo(Request $request, $slug, $code){
        $program = Program::where('slug', $slug)->first();
        $team = Team::where('code', $code)->first();

        DB::beginTransaction();

        try {
            if($slug == 'bpc-2022'){
                $store = $this->storeBPCStageTwo($request, $program, $team);
            }
            if($slug == 'ui-ux-2022'){
                $store = $this->storeUiUxStageTwo($request, $program, $team);
            }
            DB::commit();
            return redirect()->back()->with('success','Data berhasil diunggah');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error','Data gagal diunggah' . $th->getMessage());
        }
    }

    public function storeBPCStageTwo($request, $program, $team){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
        $proposal = $request->proposal;
        $presentation = $request->presentation;

        $proposalTemporaryFile = TemporaryFile::where('folder', $proposal)->first();
        $presentationTemporaryFile = TemporaryFile::where('folder', $presentation)->first();



        if($proposalTemporaryFile){
            $proposalFileName =  $team->name . '_' . $team->institution . '_Proposal' . '.' .$proposalTemporaryFile->extension;
            $proposalSourcePath = 'public/proposal/tmp/' . $proposal . '/' .$proposalTemporaryFile->file_name;
            $proposalDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$proposalFileName;
            $proposalStorage = Storage::move($proposalSourcePath, $proposalDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'proposal' => $program->slug . '/' . $team->code . '/' .$proposalFileName
            ]);

            $proposalTemporaryFile->delete();
        }

        if($presentationTemporaryFile){
            $presentationFileName = $team->name . '_' . $team->institution . '_Bahan Tayang' . '.' .$presentationTemporaryFile->extension;
            $presentationSourcePath = 'public/presentation/tmp/' . $presentation . '/' .$presentationTemporaryFile->file_name;
            $presentationDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$presentationFileName;
            $presentationStorage = Storage::move($presentationSourcePath, $presentationDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'presentation' => $program->slug . '/' . $team->code . '/' .$presentationFileName
            ]);

            $presentationTemporaryFile->delete();
        }

    }

    public function storeUiUxStageTwo($request, $program, $team){
        $programTeam = ProgramTeam::where('program_id', $program->id)->where('team_id', $team->id)->first();
        $presentation = $request->presentation;

        $presentationTemporaryFile = TemporaryFile::where('folder', $presentation)->first();


        if($presentationTemporaryFile){
            $presentationFileName = $team->name . '_' . $team->institution . '_Presentatsi' . '.' .$presentationTemporaryFile->extension;
            $presentationSourcePath = 'public/presentation/tmp/' . $presentation . '/' .$presentationTemporaryFile->file_name;
            $presentationDestinationPath = 'public/' . $program->slug . '/' . $team->code . '/' .$presentationFileName;
            $presentationStorage = Storage::move($presentationSourcePath, $presentationDestinationPath);

            \DB::table('program_team')->where('program_id', $program->id)->where('team_id', $team->id)->update([
                'presentation' => $program->slug . '/' . $team->code . '/' .$presentationFileName
            ]);

            $presentationTemporaryFile->delete();
        }

    }

    public function getTeamStage($program, $participant, $programTeam){
        $currentDateTime = Carbon::now();
        if($program->slug == 'animasi-digital-2022'){
            // dummy
            // $isPaid = 1;
            // $resultLink = null;
            // $paymentProof = 'null';
            // $fileStage1 = null;
            // $stage1Status = 'checking';
            // $report = null;

            $isPaid = $programTeam->is_paid;
            $resultLink = $programTeam->result_link;
            $paymentProof = $programTeam->payment_proof;
            $fileStage1 = $programTeam->file_stage_1;
            $stage1Status = $programTeam->stage_1_status;
            $report = $programTeam->report;

            $todos = [
                [
                    'stage' => 0,
                    'title' => 'upload bukti pembayaran',
                    'isChecked' => $paymentProof != null
                ],
                [
                    'stage' => 0,
                    'title' => 'pembayaran dikonfirmasi',
                    'isChecked' => $isPaid == 0 ? false : true
                ],
                [
                    'stage' => 1,
                    'title' => 'upload laporan',
                    'isChecked' => $report != null
                ],
                [
                    'stage' => 1,
                    'title' => 'Input Link Video',
                    'isChecked' => $resultLink != null
                ],
                [
                    'stage' => 1,
                    'title' => 'berkas persyaratan',
                    'isChecked' => $fileStage1 != null
                ],
            ];

            if($isPaid == 0 || $paymentProof == null){

                $stage = [
                    'index' => 0,
                    'number' => 0,
                    'title' => 'Stage 1',
                    'todos' => collect($todos)->where('stage', 0)
                ];

            }else{
                if($stage1Status == 'checking'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'Stage 1',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
                if($stage1Status == 'passed'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'passed',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
                if($stage1Status == 'eliminated'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'eliminated',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
            };

            return $stage;
        }

        if($program->slug == 'bpc-2022'){
            // dummy
            // $isPaid = 0;
            // $paymentProof = null;
            // $fileStage1 = null;
            // $document = null;
            // $proposal = null;
            // $presentation = null;
            // $stage1Status = 'checking';
            // $stage2Status = 'checking';

            $isPaid = $programTeam->is_paid;
            $paymentProof = $programTeam->payment_proof;
            $fileStage1 = $programTeam->file_stage_1;
            $document = $programTeam->document;
            $proposal = $programTeam->proposal;
            $presentation = $programTeam->presentation;
            $stage1Status = $programTeam->stage_1_status;
            $stage2Status = $programTeam->stage_2_status;

            $todos = [
                [
                    'stage' => 1,
                    'title' => 'dokumen',
                    'isChecked' => $document != null
                ],
                [
                    'stage' => 1,
                    'title' => 'berkas persyaratan',
                    'isChecked' => $fileStage1 != null
                ],
                [
                    'stage' => 2,
                    'title' => 'bukti pembayaran',
                    'isChecked' => $paymentProof != null
                ],
                [
                    'stage' => 2,
                    'title' => 'pembayaran dikonfirmasi',
                    'isChecked' => $isPaid != null
                ],
                [
                    'stage' => 2,
                    'title' => 'proposal',
                    'isChecked' => $proposal != null
                ],
                [
                    'stage' => 3,
                    'title' => 'file presentasi',
                    'isChecked' => $presentation != null
                ],
            ];


            if($isPaid == 0 && $stage1Status != 'passed'){

                $stage = [
                    'index' => 0,
                    'number' => 1,
                    'title' => 'Stage 1',
                    'todos' => collect($todos)->where('stage', 1)
                ];

            }else{
                if($isPaid == 0 && $stage1Status == 'passed'){
                    $stage = [
                        'index' => 1,
                        'number' => 2,
                        'title' => 'Stage 1',
                        'todos' => collect($todos)->where('stage', 2)
                    ];
                }

                if($isPaid == 1 && $paymentProof != null &&  $stage1Status == 'passed'){
                    $stage = [
                        'index' => 2,
                        'number' => 2,
                        'title' => 'Stage 2',
                        'todos' => collect($todos)->where('stage', 2)
                    ];
                }

                // if($isPaid == 1 && $paymentProof != null && $stage2Status == 'passed'){
                //     $stage = [
                //         'index' => 3,
                //         'number' => 3,
                //         'title' => 'Stage 3',
                //         'todos' => collect($todos)->where('stage', 3)
                //     ];
                // }

                if($isPaid == 1 && $paymentProof != null && $stage2Status == 'passed'){
                    $stage = [
                        'index' => 4,
                        'number' => 3,
                        'title' => 'Stage 3',
                        'todos' => collect($todos)->where('stage', 3)
                    ];
                }
                // if($stage1Status == 'eliminated' || $stage2Status == 'eliminated'){
                //     $stage = [
                //         'index' => 4,
                //         'number' => 0,
                //         'title' => 'eliminated',
                //         'todos' => []
                //     ];
                // }
            }

            return $stage;
        }

        if($program->slug == 'poster-2022'){
            // $isPaid = 0;
            // $paymentProof = 'null';
            // $fileStage1 = 'null';
            // $document = 'null';
            // $stage1Status = 'checking';

            $isPaid = $programTeam->is_paid;
            $paymentProof = $programTeam->payment_proof;
            $fileStage1 = $programTeam->file_stage_1;
            $stage1Status = $programTeam->stage_1_status;
            $document = $programTeam->document;

            $todos = [
                [
                    'stage' => 0,
                    'title' => 'bukti pembayaran',
                    'isChecked' => $paymentProof != null
                ],
                [
                    'stage' => 0,
                    'title' => 'pembayaran dikonfirmasi',
                    'isChecked' => $isPaid != 0
                ],
                [
                    'stage' => 1,
                    'title' => 'poster/dokumen',
                    'isChecked' => $document != null
                ],
                [
                    'stage' => 1,
                    'title' => 'berkas persyaratan',
                    'isChecked' => $fileStage1 != null
                ],
            ];

            if($isPaid == 0 || $paymentProof == null){

                $stage = [
                    'index' => 0,
                    'number' => 0,
                    'title' => 'Stage 1',
                    'todos' => collect($todos)->where('stage', 0)
                ];

            }else{
                if($programTeam->stage_1_status == 'checking'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'Stage 1',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
                if($programTeam->stage_1_status == 'passed'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'passed',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
                if($programTeam->stage_1_status == 'eliminated'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'eliminated',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
            }

            return $stage;
        }

        if($program->slug == 'ui-ux-2022'){
            // dummy
            $technicalMeeting = 1;

            // $isPaid = 0;
            // $paymentProof = null;
            // $fileStage1 = null;
            // $proposal = null;
            // $presentation = null;
            // $stage1Status = 'checking';


            $isPaid = $programTeam->is_paid;
            $paymentProof = $programTeam->payment_proof;
            $fileStage1 = $programTeam->file_stage_1;
            $proposal = $programTeam->proposal;
            $presentation = $programTeam->presentation;
            $stage1Status = $programTeam->stage_1_status;

            $todos = [
                [
                    'stage' => 0,
                    'title' => 'bukti pembayaran',
                    'isChecked' => $paymentProof != null
                ],
                [
                    'stage' => 0,
                    'title' => 'pembayaran dikonfirmasi',
                    'isChecked' => $isPaid != null
                ],
                [
                    'stage' => 1,
                    'title' => 'proposal',
                    'isChecked' => $proposal != null
                ],
                [
                    'stage' => 1,
                    'title' => 'berkas persyaratan',
                    'isChecked' => $fileStage1 != null
                ],
                [
                    'stage' => 2,
                    'title' => 'technical meeting',
                    'isChecked' => $fileStage1 != null
                ],
                [
                    'stage' => 2,
                    'title' => 'file presentasi',
                    'isChecked' => $presentation != null
                ],
            ];

            if($isPaid == 0 || $paymentProof == null){

                $stage = [
                    'index' => 0,
                    'number' => 0,
                    'title' => 'Stage 1',
                    'todos' => collect($todos)->where('stage', 0)
                ];

            }else{
                if($stage1Status == 'checking'){
                    $stage = [
                        'index' => 1,
                        'number' => 1,
                        'title' => 'Stage 1',
                        'todos' => collect($todos)->where('stage', 1)
                    ];
                }
                if($stage1Status == 'passed' && $technicalMeeting == 0){
                    $stage = [
                        'index' => 2,
                        'number' => 2,
                        'title' => 'Stage 2',
                        'todos' => collect($todos)->where('stage', 2)
                    ];
                }
                if($stage1Status == 'passed' && $technicalMeeting == 0){
                    $stage = [
                        'index' => 3,
                        'number' => 2,
                        'title' => 'Stage 2',
                        'todos' => collect($todos)->where('stage', 2)
                    ];
                }
                // if($stage1Status == 'passed' && $technicalMeeting == 0 && $presentation == null){
                //     $stage = [
                //         'index' => 3,
                //         'number' => 2,
                //         'title' => 'Stage 2',
                //         'todos' => collect($todos)->where('stage', 2)
                //     ];
                // }
                if($stage1Status == 'passed' && $technicalMeeting == 1){
                    $stage = [
                        'index' => 4,
                        'number' => 2,
                        'title' => 'Stage 2',
                        'todos' => collect($todos)->where('stage', 2)
                    ];
                }
            };

            return $stage;
        }
    }

}
