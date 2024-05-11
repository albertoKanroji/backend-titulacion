<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\RutinasControllerAPI;
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

        Route::get('/', [RutinasControllerAPI::class, 'index'])->name('usuarios.login');
    
    });


});
