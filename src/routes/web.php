<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackLogController;
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
    return view('welcome');
});

Route::get("/login", function () {
    return view("login");
})->name("login");
Route::post("/auth/login", [AuthController::class, "postLogin"]);

Route::get("/register", function () {
    return view("register");
})->name("register");
Route::post("auth/register", [AuthController::class, "postRegister"]);

Route::post("/logout", [AuthController::class, "postLogout"])->name("logout");

Route::group(["middleware" => "auth"], function () {
    Route::get("/backlog", [BackLogController::class, "index"]);
    Route::get("/backlog/user-story/{id}", [BackLogController::class, "getUserStory"]);
    Route::get("/backlog/add-user-story", [BackLogController::class, "getAddUserStory"]);
    Route::post("/backlog/add-user-story", [BackLogController::class, "postAddUserStory"]);
});
