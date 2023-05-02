<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\TeamUserApiController;
use App\Http\Controllers\api\CompetitionApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', [CompetitionApiController::class, 'test']);

Route::post('/store-tmp-payment', [CompetitionApiController::class, 'storeTmpPayment'])->name('apiStorePayment');

Route::post('/store-tmp-initial-file', [CompetitionApiController::class, 'storeTmpInitialFile'])->name('apiStoreInitialfile');

// UI UX
Route::post('/store-tmp-ui-ux-file-stage-1', [CompetitionApiController::class, 'storeTmpUiUXFileStageOne'])->name('apiStoreUiUxfileStageOne');
Route::post('/store-tmp-ui-ux-proposal', [CompetitionApiController::class, 'storeTmpUiUXProposal'])->name('apiStoreUiUxProposal');
Route::post('/store-tmp-ui-ux-presentation', [CompetitionApiController::class, 'storeTmpUiUXPresentation'])->name('apiStoreUiUxPresentation');

// Digital Animation
Route::post('/store-tmp-digital-animation-file-stage-1', [CompetitionApiController::class, 'storeTmpDigitalAnimationFileStageOne'])->name('apiStoreDigitalAnimationFileStageOne');
Route::post('/store-tmp-digital-animation-report', [CompetitionApiController::class, 'storeTmpDigitalAnimationReport'])->name('apiStoreDigitalAnimationReport');

// BPC
Route::post('/store-tmp-bpc-file-stage-1', [CompetitionApiController::class, 'storeTmpBPCFileStageOne'])->name('apiStoreBPCFileStageOne');
Route::post('/store-tmp-bpc-document', [CompetitionApiController::class, 'storeTmpBPCDocument'])->name('apiStoreBPCDocument');
Route::post('/store-tmp-bpc-proposal', [CompetitionApiController::class, 'storeTmpBPCProposal'])->name('apiStoreBPCProposal');
Route::post('/store-tmp-bpc-presentation', [CompetitionApiController::class, 'storeTmpBPCPresentation'])->name('apiStoreBPCPresentation');

// Poster
Route::post('/store-tmp-poster-file-stage-1', [CompetitionApiController::class, 'storeTmpPosterFileStageOne'])->name('apiStorePosterFileStageOne');
Route::post('/store-tmp-poster-document', [CompetitionApiController::class, 'storeTmpPosterDocument'])->name('apiStorePosterDocument');

Route::post('/store-logo', [TeamUserApiController::class, 'storeLogo'])->name('apiStoreLogo');
Route::get('/assemble-member/find/{email}', [TeamUserApiController::class, 'findMember'])->name('apiFindMember');
Route::post('/assemble-member/add', [TeamUserApiController::class, 'addMember'])->name('apiAddMember');
