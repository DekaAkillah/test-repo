<?php

namespace App\Http\Controllers\api;

use App\Models\Program;
use App\Models\TeamUser;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CompetitionApiController extends Controller
{
    public function test(){
        // $userTeam = TeamUser::where('team_id',29)->where('user_id', 3)->first();
        // dd($userTeam);
        // \DB::table('team_user')->where('team_id',29)->where('user_id', 2)->delete();
    }

    public function storeTmpPayment(Request $request){
        if($request->hasFile('payment_proof')){
            $file=$request->file('payment_proof');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/payments/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }
    }

    // Digital Animation
    public function storeTmpDigitalAnimationFileStageOne(Request $request){
        if($request->hasFile('file_stage_1')){
            $file=$request->file('file_stage_1');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/file_stage_1/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpDigitalAnimationReport(Request $request){
        if($request->hasFile('report')){
            $file=$request->file('report');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/report/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    // BPC
    public function storeTmpBPCFileStageOne(Request $request){
        if($request->hasFile('file_stage_1')){
            $file=$request->file('file_stage_1');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/file_stage_1/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpBPCDocument(Request $request){
        if($request->hasFile('document')){
            $file=$request->file('document');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/document/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpBPCProposal(Request $request){
        if($request->hasFile('proposal')){
            $file=$request->file('proposal');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/proposal/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpBPCPresentation(Request $request){
        if($request->hasFile('presentation')){
            $file=$request->file('presentation');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/presentation/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    // UIUX
    public function storeTmpUiUXFileStageOne(Request $request){
        if($request->hasFile('file_stage_1')){
            $file=$request->file('file_stage_1');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/file_stage_1/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpUiUXProposal(Request $request){
        if($request->hasFile('proposal')){
            $file=$request->file('proposal');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/proposal/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    public function storeTmpUiUXPresentation(Request $request){
        if($request->hasFile('presentation')){
            $file=$request->file('presentation');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/presentation/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }

    // Poster
    public function storeTmpPosterFileStageOne(Request $request){
        if($request->hasFile('file_stage_1')){
            $file=$request->file('file_stage_1');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/file_stage_1/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }
    public function storeTmpPosterDocument(Request $request){
        if($request->hasFile('document')){
            $file=$request->file('document');
            $fileName = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $extension = $file->getClientOriginalExtension();
            $file->storeAs('public/document/tmp/'. $folder, $fileName);

            TemporaryFile::create([
                'folder' => $folder,
                'file_name' => $fileName,
                'extension' => $extension,
            ]);

            return $folder;
        }

        return '';
    }
}
