<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\ProjectPageController;
use App\Http\Controllers\Guest\ProjectShowController;


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

Route::get('/', function () {
    return view('guest.welcome');
});

Route::get('/projects', [ProjectPageController::class, 'index']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //localhost:8000/admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //localhost:8000/admin/project
    //localhost:8000/admin/project/{post}
    //localhost:8000/admin/project/create
    Route::resource('/project', ProjectController::class)->parameters(
        [
            'project' => 'project:slug'
        ]
    );

});



require __DIR__.'/auth.php';

Route::get('/{project}', [ProjectShowController::class, 'show'])->name('show');
