<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
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

Route::middleware(['auth:admin'])->group(function(){
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

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
     * All Brands Route
     */
    Route::prefix('brand')->group(function(){
        Route::get('/view', [BrandController::class, 'viewBrand'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'storeBrand'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
        Route::post('/update', [BrandController::class, 'updateBrand'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
    });

    /**
     * All Categories Route
     */
    Route::prefix('category')->group(function(){
        Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'storeCategory'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
        Route::post('/update', [CategoryController::class, 'updateCategory'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');
    });

    /**
     * All Sub Categories Route
     */
    Route::prefix('category')->group(function(){
        Route::get('/sub/view', [SubCategoryController::class, 'viewSubCategory'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'storeSubCategory'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('subcategory.edit');
        Route::post('/sub/update', [SubCategoryController::class, 'updateSubCategory'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');
    });

    /**
     * All Sub SubCategories Route
     */
    Route::prefix('category')->group(function(){
        Route::get('/sub/sub/view', [SubCategoryController::class, 'viewSubSubCategory'])->name('all.subsubcategory');
        Route::post('/sub/sub/store', [SubCategoryController::class, 'storeSubSubCategory'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'editSubSubCategory'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update', [SubCategoryController::class, 'updateSubSubCategory'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'deleteSubSubCategory'])->name('subsubcategory.delete');
        //FindOut SubCategory and Sub SubCategory
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubCategory']);
    });

    /**
     * All Products Route
     */
    Route::prefix('product')->group(function(){
        Route::get('/add', [ProductController::class, 'addProduct'])->name('add.product');
        Route::post('/store', [ProductController::class, 'storeProduct'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::post('/update', [ProductController::class, 'updateProduct'])->name('product.update');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

        //Product Manage
        Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage.product');
        //Multiple Image Update
        Route::post('/image/update', [ProductController::class, 'multiImageUpdate'])->name('product.update.image');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'deleteMultiImage'])->name('product.multiimg.delete');
        //Thumbnail Image Update
        Route::post('/thumbnail/update', [ProductController::class, 'thumbnailImageUpdate'])->name('product.update.thumbnail');
        //Product Active And Inactive
        Route::get('/inactive/{id}', [ProductController::class, 'inactiveProduct'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'activeProduct'])->name('product.active');
    });


    /**
     * All Sliders Route
     */
    Route::prefix('slider')->group(function(){
        Route::get('/view', [SliderController::class, 'viewSlider'])->name('manage.slider');
        Route::post('/store', [SliderController::class, 'storeSlider'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'editSlider'])->name('slider.edit');
        Route::post('/update', [SliderController::class, 'updateSlider'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'deleteSlider'])->name('slider.delete');
        //Slider Active And Inactive
        Route::get('/inactive/{id}', [SliderController::class, 'inactiveSlider'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'activeSlider'])->name('slider.active');
    });
}); //End of middleware

/**
 * Frontend All Routes
 */
//User Dashboard
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id   = Auth::user()->id;
    $user = User::find($id);

    return view('dashboard', compact('user'));
})->name('dashboard');
//User Profile
Route::get('/', [indexController::class, 'index']);
Route::get('/user/logout', [indexController::class, 'userLogout'])->name('user.logout');
Route::get('/user/profile', [indexController::class, 'userProfile'])->name('user.profile');
Route::post('/user/profile/store', [indexController::class, 'userProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [indexController::class, 'userChangePassword'])->name('change.password');
Route::post('/user/password/update', [indexController::class, 'userPasswordUpdate'])->name('user.password.update');