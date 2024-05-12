<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\RutinasControllerAPI;
use App\Http\Controllers\GruposMuscularesControllerlAPI;
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

Route::prefix('v1')->group(function () {

    Route::prefix('usuarios')->group(function () {

        //  Route::get('/', [CustomersController::class, 'index'])->name('usuarios.index');
        Route::post('/login', [CustomersController::class, 'login'])->name('usuarios.login');
        Route::post('/', [CustomersController::class, 'store'])->name('usuarios.store');
        // Route::get('/{id}', [CustomersController::class, 'show'])->name('usuarios.show');
        // Route::put('/{id}', [CustomersController::class, 'update'])->name('usuarios.update');
        // Route::delete('/{id}', [CustomersController::class, 'destroy'])->name('usuarios.destroy');
    });

    Route::prefix('rutinas')->group(function () {

        Route::get('/', [RutinasControllerAPI::class, 'index']);
        Route::get('/{id}', [RutinasControllerAPI::class, 'show']);
        Route::get('/{id}/ejercicios', [RutinasControllerAPI::class, 'showEjercicios']);
    
    });
    Route::prefix('grupos-musculares')->group(function () {

        Route::get('/', [GruposMuscularesControllerlAPI::class, 'index']);
         Route::get('/{id}', [GruposMuscularesControllerlAPI::class, 'show']);
        Route::get('/{id}/video', [GruposMuscularesControllerlAPI::class, 'showVideos']);
        Route::get('/video/{id}', [GruposMuscularesControllerlAPI::class, 'showVideoDetail']);
    });


});
