<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\AuthControllers;
use App\Http\Controllers\WEB\AdminControllers;
use App\Http\Controllers\WEB\UserControllers;
use App\Http\Controllers\WEB\MonitoringControllers;
use App\Http\Controllers\WEB\Mata_pelajaranControllers;
use App\Http\Controllers\WEB\AssignmentControllers;
use App\Http\Controllers\WEB\LampiranControllers;
use App\Http\Controllers\WEB\SubmissionControllers;
use App\Http\Controllers\WEB\ScoreControllers;
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

Route::get('/', [AuthControllers::class, 'logpage']);
Route::post('/login', [AuthControllers::class, 'login']);
Route::get('/logout', [AuthControllers::class, 'logout']);

Route::middleware('authname')->group(function () {
Route::get('/dashboard', [UserControllers::class, 'index']);
Route::get('/monitoring', [MonitoringControllers::class, 'monitoring']);
Route::get('/admin', [AdminControllers::class, 'index']);

});

Route::prefix('user')->group(function () {
    Route::post('/add-user',[UserControllers::class, 'register']);
    Route::get('/edit/{id}',[UserControllers::class, 'edituserpage']);
    Route::put('/edit-store/{id}',[UserControllers::class, 'edituser']);
    Route::get('/delete/{id}',[UserControllers::class, 'delete']);
});

Route::prefix('admin')->group(function () {
    Route::post('/add-admin',[AdminControllers::class, 'create']);
    Route::get('/edit/{id}',[AdminControllers::class, 'editadminpage']);
    Route::put('/edit-store/{id}',[AdminControllers::class, 'editadmin']);
    Route::get('/delete/{id}',[AdminControllers::class, 'delete']);
});

Route::prefix('mapel')->group(function () {
    Route::post('/create',[Mata_pelajaranControllers::class, 'create']);
    Route::get('/',[Mata_pelajaranControllers::class, 'index']);
    Route::get('/{uuid}',[Mata_pelajaranControllers::class, 'byId']);
    Route::get('/edit/{uuid}',[Mata_pelajaranControllers::class, 'editpage']);
    Route::put('/edit-store/{uuid}',[Mata_pelajaranControllers::class, 'edit']);
    Route::get('/delete/{uuid}',[Mata_pelajaranControllers::class,'delete']);
});

// <!--ASSIGNMENT---!>

Route::prefix('assignment')->group(function () {
    Route::post('/create', [AssignmentControllers::class, 'create']);
    Route::get('/', [AssignmentControllers::class, 'index']);
    Route::get('/{uuid}',[AssignmentControllers::class, 'byId']);
    Route::get('/edit/{uuid}',[AssignmentControllers::class, 'editpage']);
    Route::put('/edit-store/{uuid}',[AssignmentControllers::class, 'edit'])->name('edit_assignment(web)');
    Route::get('/delete/{uuid}', [AssignmentControllers::class, 'delete'])->name('delete_assignment(web)');
});

// <!--SUBMISSION---!>

Route::prefix('submission')->group(function () {
    Route::get('/', [SubmissionControllers::class, 'index']);
    Route::get('/{uuid}', [SubmissionControllers::class, 'byId']);
});

// <!--SCORE---!>
Route::prefix('score')->group(function () {
    Route::post('/score', [ScoreControllers::class, 'score']);
    Route::put('/edit/{uuid}',[ScoreControllers::class, 'edit']);
    Route::get('/delete/{uuid}', [ScoreControllers::class, 'delete']);
});

//<!--LAMPIRAN---!>
Route::prefix('lampiran')->group(function () {
    Route::post('/create',[LampiranControllers::class, 'create']);
    Route::get('/delete/{uuid}',[LampiranControllers::class, 'delete']);
});

Route::prefix('profile')->group(function () {
    Route::get('/admin',[AdminControllers::class, 'profileadminpage']);
    Route::put('/edit-store',[AdminControllers::class, 'editprofileadmin']);
    Route::put('/edit-photo',[AdminControllers::class, 'editphotoprofil']);
});
