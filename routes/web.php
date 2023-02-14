<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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
/*-----Login page------*/
Route::get('/', [HomeController::class, 'index'])->name('index');

/*-----Dashboard------*/
Route::get('/dashboard', function () {
    return view('layouts.dashboard-content');
})->middleware(['auth'])->name('dashboard');


Route::middleware('admin')->group(function () {
    /*-----users management------*/
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('admin.users');
    Route::get('/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('/update', [App\Http\Controllers\UsersController::class, 'update'])->name('admin.users.update');
    /*-----project------*/
    Route::get('/project', [App\Http\Controllers\ProjectController::class, 'index'])->name('admin.project');
    Route::get('/project-create', [App\Http\Controllers\ProjectController::class, 'create'])->name('admin.project.create');
    Route::get('/project-edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('admin.project.edit');
    Route::post('/project-store', [App\Http\Controllers\ProjectController::class, 'store'])->name('admin.project.store');
    Route::post('/project-update', [App\Http\Controllers\ProjectController::class, 'update'])->name('admin.project.update');
});
/*-----Task------*/
Route::middleware('auth')->group(function () {
    Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('admin.task');
    Route::get('/task-view/{id}', [App\Http\Controllers\TaskController::class, 'view'])->name('admin.task.view');

});
Route::middleware(['employee'])->group(function () {
    Route::get('/task-create', [App\Http\Controllers\TaskController::class, 'create'])->name('admin.task.create');
    Route::get('/task-edit/{id}', [App\Http\Controllers\TaskController::class, 'edit'])->name('admin.task.edit');
    Route::post('/task-store', [App\Http\Controllers\TaskController::class, 'store'])->name('admin.task.store');
    Route::post('/task-update', [App\Http\Controllers\TaskController::class, 'update'])->name('admin.task.update');
    Route::get('/task-start/{id}', [App\Http\Controllers\TaskController::class, 'start'])->name('admin.task.start');
    Route::get('/task-stop/{id}', [App\Http\Controllers\TaskController::class, 'stop'])->name('admin.task.stop');
    Route::get('/task-break-start/{id}', [App\Http\Controllers\TaskController::class, 'breakStart'])->name('admin.task.breakStart');
    Route::get('/task-break-end/{id}', [App\Http\Controllers\TaskController::class, 'breakEnd'])->name('admin.task.breakEnd');
});
Route::get('/download/{name}', [App\Http\Controllers\TaskController::class, 'getDownload'])->name('admin.task.download');
require __DIR__ . '/auth.php';
