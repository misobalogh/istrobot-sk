<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllRobotsController;
use App\Http\Controllers\AllUsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RobotController;
use App\Http\Controllers\StatisticsController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

// Force HTTPS scheme
URL::forceScheme('https');

/*
|--------------------------------------------------------------------------
| GUEST Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Redirect to the contest page with the current year set
    $setYear = session('contest_year', Setting::where('key', 'competition_year')->first()->value);
    return redirect()->route('contest.show', ['year' => $setYear]);
});

// Main page with information about the contest
Route::get('/contest/{year}', [ContestController::class, 'show'])
    ->where('year', '\d+') // Only digits are allowed
    ->name('contest.show');


// Registered robots for the contest
Route::get('/contest/{year}/registered-robots', [ContestController::class, 'showRegisteredRobots'])
    ->where('year', '\d+') // Only digits are allowed
    ->name('registered-robots');

// Archive page with list of years
Route::get('/archive', [ContestController::class, 'archive'])->name('archive');

/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Update user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Update robots
    Route::get('/robots', [RobotController::class, 'edit'])->name('robots.edit');
    Route::post('/robots', [RobotController::class, 'store'])->name('robots.store');
    Route::patch('/robots/{robot}', [RobotController::class, 'update'])->name('robots.update');
    Route::delete('/robots/{robot}', [RobotController::class, 'destroy'])->name('robots.destroy');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD Route
|--------------------------------------------------------------------------
*/
// Basic information about the user
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Registration form for the contest (checkboxes)
Route::post('/dashboard/update-registration', [DashboardController::class, 'updateRegistration'])->middleware(['auth', 'verified'])->name('dashboard.updateRegistration');

/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    // Set the current year for the contest
    Route::post('/admin/set-year', [AdminController::class, 'setYear'])->name('admin.setYear');

    // Admin dashboard
    Route::post('/admin/generate-starting-list/{year}', [AdminController::class, 'generateStartingList'])->name('admin.generateStartingList');
    
    Route::get('/admin/get-emails', [AdminController::class, 'allEmails'])->name('admin.allEmails');
    Route::get('/admin/get-emails/{year}', [AdminController::class, 'emailsByYear'])->name('admin.emailsByYear');
    
    Route::get('/admin/starting-list', [AdminController::class, 'showStartingList'])->name('admin.startingList');
    
    Route::post('/admin/create-category', [AdminController::class, 'createCategory'])->name('admin.create-category');
    Route::delete('/admin/delete-category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.delete-category');
    
    Route::post('/admin/set-categories/{year}', [AdminController::class, 'setCategories'])->name('admin.setCategories');
    Route::get('/admin/get-categories/{year}', [AdminController::class, 'getCategories'])->name('admin.getCategories');

    // Manage all users
    Route::get('/all-users', [AllUsersController::class, 'list'])->name('all-users.list');
    Route::delete('/all-users/delete/{user}', [AllUsersController::class, 'destroy'])->name('all-users.destroy');
    Route::post('/all-users/update/{user}', [AllUsersController::class, 'update'])->name('all-users.update');
    Route::get('/all-users/{user}/edit', [AllUsersController::class, 'edit']);
    
    // Manage all robots
    Route::get('/all-robots', [AllRobotsController::class, 'list'])->name('all-robots.list');
    Route::get('/all-robots/{robot}/edit', [AllRobotsController::class, 'edit'])->name('all-robots.edit');
    Route::post('/all-robots/update/{robot}', [AllRobotsController::class, 'update'])->name('all-robots.update');
    Route::delete('/all-robots/delete/{robot}', [AllRobotsController::class, 'destroy'])->name('all-robots.destroy');

    Route::get('/admin/statistics', [StatisticsController::class, 'index'])->name('admin.statistics');
});

/*
|--------------------------------------------------------------------------
| LANGUAGE switch
|--------------------------------------------------------------------------
*/
Route::get('lang/{locale}', function ($locale) {
    // Check if the locale is supported
    if (!in_array($locale, ['en', 'sk'])) {
        abort(400);
    }
    // Set the locale in the session
    session(['locale' => $locale]);
    return redirect()->back();
})->name('lang.switch');

require __DIR__ . '/auth.php';
