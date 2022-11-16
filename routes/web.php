<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// system vote
Route::resource('/score', ScoreController::class);
// voter and user
Route::post('/users/search', [UserController::class, 'search_voter']);
Route::resource('/users', UserController::class);
Route::get('/voters/score', [VoterController::class, 'score']);
Route::post('/voters/search', [VoterController::class, 'search_voter']);
Route::resource('/voters', VoterController::class);
// admin
Route::post('/admin/search/member', [AdminController::class, 'search_member']);
Route::post('/admin/search', [AdminController::class, 'search_voter']);
Route::post('/admin/search/date', [AdminController::class, 'search_date']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/voters', [AdminController::class, 'voters']);
Route::get('/admin/voters/{id}', [AdminController::class, 'voter_approve']);
Route::resource('/admin', AdminController::class);