<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\AdminProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

/**
 * Admin All Routes
 */
//Profile Update
Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
//Change Password
Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
Route::post('/update/change/password', [AdminProfileController::class, 'adminUpdateChangePassword'])->name('update.change.password');

/**
 * User All Routes
 */
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id   = Auth::user()->id;
    $user = User::find($id);

    return view('dashboard', compact('user'));
})->name('dashboard');


/**
 * Frontend All Routes
 */
Route::get('/', [indexController::class, 'index']);
Route::get('/user/logout', [indexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [indexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [indexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [indexController::class, 'userChangePassword'])->name('change.password');
Route::post('/user/password/update', [indexController::class, 'userPasswordUpdate'])->name('user.password.update');