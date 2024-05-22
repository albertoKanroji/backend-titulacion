<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\SignUp;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Billing;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Tables;
use App\Http\Livewire\StaticSignIn;
use App\Http\Livewire\StaticSignUp;
use App\Http\Livewire\Rtl;
use App\Http\Livewire\Clientes\ClientesController;
use App\Http\Livewire\LaravelExamples\UserProfile;
use App\Http\Livewire\LaravelExamples\UserManagement;
use App\Http\Livewire\Clientes\CrearClientesController;
use Illuminate\Http\Request;
use App\Http\Livewire\Rutinas\RutinasController;
use App\Http\Livewire\Rutinas\RutinasPersonalizadaController;
use App\Http\Livewire\Videos\VideosEjercicios;
use App\Http\Livewire\GruposMusculares\GruposMuscularesController;
use App\Http\Livewire\Etiquetas\Equipo\EquipoController;
use App\Http\Livewire\Etiquetas\Tag\TagController;
use App\Http\Livewire\GruposMusculares\GrupoMuscularCrear;

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
    return redirect('/login');
});

Route::get('/sign-up', SignUp::class)->name('sign-up');
Route::get('/login', Login::class)->name('login');

Route::get('/login/forgot-password', ForgotPassword::class)->name('forgot-password');

Route::get('/reset-password/{id}', ResetPassword::class)->name('reset-password')->middleware('signed');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/clientes', ClientesController::class)->name('clientes');
    Route::get('/tags', TagController::class)->name('tags');
    Route::get('/equipo', EquipoController::class)->name('equipo');
    Route::get('/videos-todos', VideosEjercicios::class)->name('videos-todos');
    Route::get('/rutinas-publicas', RutinasController::class)->name('rutinas-publicas');
    Route::get('/grupos-musculares', GruposMuscularesController::class)->name('grupos-musculares');
    Route::get('/rutinas-perzonalizada', RutinasPersonalizadaController::class)->name('rutinas-perzonalizada');
    Route::get('/clientes-crear/{id?}', CrearClientesController::class)->name('clientes-crear');
    Route::get('/gm-crear/{id?}', GrupoMuscularCrear::class)->name('gm-crear');
    Route::get('/billing', Billing::class)->name('billing');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/tables', Tables::class)->name('tables');
    Route::get('/static-sign-in', StaticSignIn::class)->name('sign-in');
    Route::get('/static-sign-up', StaticSignUp::class)->name('static-sign-up');
    Route::get('/rtl', Rtl::class)->name('rtl');
    Route::get('/laravel-user-profile', UserProfile::class)->name('user-profile');
    Route::get('/laravel-user-management', UserManagement::class)->name('user-management');
});
