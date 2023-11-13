<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthControllers;
use App\Http\Controllers\API\UserControllers;
use App\Http\Controllers\API\Mata_pelajaranControllers;
use App\Http\Controllers\API\AssignmentControllers;
use App\Http\Controllers\API\LampiranControllers;
use App\Http\Controllers\API\SubmissionControllers;
use App\Http\Controllers\API\ScoreControllers;
use App\Http\Controllers\API\NotifControllers;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// <!--AUTH--!>

Route::prefix('auth')->group(function () {
    Route::post('/login',[AuthControllers::class, 'login']);
    Route::post('/logout', [AuthControllers::class, 'logout']);
    Route::get('/me', [AuthControllers::class, 'getUserByToken']);
    Route::post('/register', [AuthControllers::class, 'register']);
});

// <!--USER--!>

Route::prefix('user')->group(function () {
    Route::get('/friend', [UserControllers::class, 'myfriend']);
    Route::post('/edit-profile',[UserControllers::class, 'edit']);
    Route::post('/edit-password',[UserControllers::class, 'editPassword']);
    Route::post('/edit-password/{token}',[UserControllers::class, 'editPasswordToken']);
    Route::post('/forgot-password',[UserControllers::class, 'forgotPassword']);
});

// <!--MAPEL---!>

Route::prefix('mapel')->group(function () {
    Route::post('/create',[Mata_pelajaranControllers::class, 'create']);
    Route::get('/',[Mata_pelajaranControllers::class, 'index']);
    Route::get('/{uuid}',[Mata_pelajaranControllers::class, 'byId']);
    Route::post('/edit/{uuid}',[Mata_pelajaranControllers::class, 'edit']);
    Route::delete('/delete/{uuid}',[Mata_pelajaranControllers::class,'delete']);
});

// <!--ASSIGNMENT---!>

Route::prefix('assignment')->group(function () {
    Route::post('/create', [AssignmentControllers::class, 'create']);
    Route::get('/', [AssignmentControllers::class, 'index']);
    Route::get('/{uuid}',[AssignmentControllers::class, 'byId']);
    Route::post('/edit/{uuid}',[AssignmentControllers::class, 'edit'])->name('edit_assignment');
    Route::delete('/delete/{uuid}', [AssignmentControllers::class, 'delete'])->name('delete_assignment');
});

// <!--SUBMISSION---!>

Route::prefix('submission')->group(function () {
    Route::post('/file', [SubmissionControllers::class, 'file_submission']);
    Route::post('/link', [SubmissionControllers::class, 'link_submission']);
    Route::delete('/delete/{uuid}', [SubmissionControllers::class, 'delete']);
});

// <!--SCORE---!>
Route::prefix('score')->group(function () {
    Route::post('/score', [ScoreControllers::class, 'score']);
    Route::post('/edit/{uuid}',[ScoreControllers::class, 'edit'])->name('edit_score');
    Route::delete('/delete/{uuid}', [ScoreControllers::class, 'delete'])->name('delete_review');
});

//<!--LAMPIRAN---!>
Route::prefix('lampiran')->group(function () {
    Route::post('/create',[LampiranControllers::class, 'create']);
    Route::delete('/delete/{uuid}',[LampiranControllers::class, 'delete']);
});

//<!--NOTIF---!>
Route::prefix('notif')->group(function () {
    Route::post('/getnotifmass',[NotifControllers::class, 'getNotifyMass']);
    Route::post('/getnotif',[NotifControllers::class, 'getNotify']);
    Route::post('/add',[NotifControllers::class, 'NewTask']);
    Route::post('/edit/{uuid}',[NotifControllers::class, 'Reminder']);
  
});
