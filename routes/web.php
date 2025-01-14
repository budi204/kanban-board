<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::prefix('user')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name("login")->middleware("guest");
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware("auth");
});

Route::redirect('/', "/kanban");
Route::resource("kanban", KanbanController::class)->except(["create", "destroy", "edit", "show", "store"]);
Route::resource("dashboard/kanban", TaskController::class)->middleware("admin");
Route::resource("dashboard/user", UserController::class)->middleware("admin");
