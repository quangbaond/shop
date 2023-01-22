<?php
use App\Http\Controllers\Admin\{LoginController, UserController, HomeController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest:admin')->name('admin.')->group(function (){
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});
Route::middleware('adminAuthenticated')->name('admin.')->group(function (){
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::resource('users', UserController::class);
});

