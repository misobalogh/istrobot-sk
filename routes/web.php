<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllRobotsController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\RobotController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| GUEST Routes
|--------------------------------------------------------------------------
|
| Redirects to the current year contest page
*/
Route::get('/', function () {
    $currentYear = now()->year;
    return redirect()->route('contest.show', ['year' => $currentYear]);
});

/*
| 
| Main page with information about the contest
*/
Route::get('/contest/{year}', [ContestController::class, 'show'])->name('contest.show');




/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/robots', [RobotController::class, 'edit'])->name('robots.edit');
    Route::patch('/robots/{robot}', [RobotController::class, 'update'])->name('robots.update');
    Route::delete('/robots/{robot}', [RobotController::class, 'destroy'])->name('robots.destroy');

    Route::get('/all-users', [AllUsersController::class, 'list'])->name('all-users.list');
    Route::get('/all-robots', [AllRobotsController::class, 'list'])->name('all-robots.list');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::post('/admin/generate-starting-list/{year}', [AdminController::class, 'generateStartingList'])->name('admin.generateStartingList');
    Route::get('/admin/get-emails', [AdminController::class, 'allEmails'])->name('admin.allEmails');
    Route::get('/admin/get-emails/{year}', [AdminController::class, 'emailsByYear'])->name('admin.emailsByYear');
});

require __DIR__ . '/auth.php';