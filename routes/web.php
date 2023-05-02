<?php

use App\Models\Program;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompetitionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Testing

Route::get('/testing/upload', function(){
    return view('testing.file-upload', [
        'title' => 'Test Upload'
    ]);
});


Route::get('/', function () {
    $programs = Program::where('is_active', 1)->get();

    return view('homepage.index', [
        'programs' => $programs
    ]);
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/register', [AuthController::class, 'registration'])->name('registration');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password.get');
Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
// Route::get('/verify-email', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

Route::get('/competition/{slug}', [CompetitionController::class, 'show'])->name('competition.show');

Route::middleware(['auth',])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/competition/{slug}/create-team', [CompetitionController::class, 'createTeam'])->name('competition.create-team');
    Route::post('/competition/{slug}/create-team', [CompetitionController::class, 'storeTeam'])->name('competition.store-team');

    Route::get('/competition/{slug}/join-team',[CompetitionController::class, 'joinTeam'])->name('competition.join-team');

    Route::post('/competition/{slug}/join-team/result', [CompetitionController::class, 'joinTeamResult'])->name('competition.join-team-result');

    Route::post('/join-team', [CompetitionController::class, 'participantJoinTeam'])->name('join-team');

    Route::get('/competition/{slug}/{teamCode}/assemble-member', [CompetitionController::class, 'assembleMember'])->name('competition.asassemble-member');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/edit-profile', [DashboardController::class, 'editProfile'])->name('dashboard.edit-profile');

    Route::post('/dashboard/edit-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.update-profile');

    Route::get('/dashboard/edit-profile/change-password', [DashboardController::class, 'changePassword'])->name('dashboard.change-password');

    Route::post('/dashboard/edit-profile/change-password', [DashboardController::class, 'updatePassword'])->name('dashboard.change-password.post');

    Route::get('/dashboard/{competitionSlug}/{teamCode}/edit', [DashboardController::class, 'editTeam'])->name('dashboard.edit-team');

    Route::post('/dashboard/{competitionSlug}/{teamCode}/edit', [DashboardController::class, 'updateTeam'])->name('dashboard.edit-team.post');

    Route::get('/dashboard/{competitionSlug}/{team_code}', [DashboardController::class, 'showTeam'])->name('dashboard.show-team');

    Route::post('/dashboard/{competitionSlug}/{team_code}/store-payment', [DashboardController::class, 'storePayment'])->name('dashboard.store-payment');

    Route::post('/dashboard/{competitionSlug}/{team_code}/stage-one', [DashboardController::class, 'stageOne'])->name('dashboard.stage-one');

    Route::post('/dashboard/{competitionSlug}/{team_code}/stage-two', [DashboardController::class, 'stageTwo'])->name('dashboard.stage-two');

    Route::post('/dashboard/{competitionSlug}/{team_code}/stage-three', [DashboardController::class, 'stageThree'])->name('dashboard.stage-three');

});

Route::get('/talkshow', function () {
  $user = auth()->user();

  return view('homepage.talkshow', [
      'title' => 'Talkshow',
      'user' => $user
  ]);
});

Route::get('/talkshow/reg/{code}/success', function () {
  return view('homepage.talkshow.register-success', [
    'title' => 'Talkshow Register',
  ]);
});
