<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\logoutcontroller;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\MasterHeadImageController;
use App\Http\Controllers\usercontroller;
use App\Models\Catagory;
use App\Models\MasterHeadImage;

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
    $cat = Catagory::all();
    $catagory_all = $cat->sortByDesc('id')->toQuery()->paginate(12);

    $multi_images = MasterHeadImage::all();


    return view('main.index', compact('catagory_all', 'multi_images'));
})->name('home');

Route::get('/dashboard', function () {
    $multi_images = MasterHeadImage::all();
    return view('admin.indexAdmin', compact('multi_images'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/userDashboard', function () {
    return view('admin.indexUser');
})->middleware(['auth', 'verified'])->name('userDashboard');

Route::get('/logout', [logoutcontroller::class, 'logOut'])->name('logOut');


require __DIR__ . '/auth.php';

Route::controller(admincontroller::class)->group(function () {
    Route::get('/homeAdmin', 'homeAdmin')->name('homeAdmin');
    Route::get('/adminProfile', 'adminProfile')->name('adminProfile');
    Route::get('/adminProfileEdit', 'adminProfileEdit')->name('adminProfileEdit');
    Route::post('/adminProfileUpdate', 'adminProfileUpdate')->name('adminProfileUpdate');
    Route::get('/AdminChangePassword', 'AdminChangePassword')->name('AdminChangePassword');
    Route::post('/AdminUpdatePassword', 'AdminUpdatePassword')->name('AdminUpdatePassword');
    Route::get('/userManage', 'userManage')->name('userManage');
    Route::get('/userDelete/{id}', 'userDelete')->name('userDelete');

    Route::get('/allCatagory', 'allCatagory')->name('allCatagory');
    Route::get('/addCat', 'addCat')->name('addCat');
    Route::post('/addCatagory', 'addCatagory')->name('addCatagory');
    Route::get('/deleteCatagory/{id}', 'deleteCatagory')->name('deleteCatagory');
    Route::get('/editCatagory/{id}', 'editCatagory')->name('editCatagory');
    Route::post('/updateCatagory', 'updateCatagory')->name('updateCatagory');
    Route::get('/productsForSale', 'productsForSale')->name('productsForSale');
    Route::get('/deleteProducts/{id}', 'deleteProducts')->name('deleteProducts');
    Route::get('/adminWallet', 'adminWallet')->name('adminWallet');
    Route::get('/adminProductImages/{id}', 'adminProductImages')->name('adminProductImages');
    Route::post('/rejectProduct', 'rejectProduct')->name('rejectProduct');
    Route::get('/allProductsForSell/{id}', 'allProductsForSell')->name('allProductsForSell');
    Route::get('/adminallProductsForSell/{id}', 'adminallProductsForSell')->name('adminallProductsForSell');
    Route::get('/ProductShowAllComments/{id}', 'ProductShowAllComments')->name('ProductShowAllComments');
    Route::post('/postComment', 'postComment')->name('postComment');
    Route::get('/adminCommentsShow/{id}', 'adminCommentsShow')->name('adminCommentsShow');
    Route::get('/deleteComment/{id}', 'deleteComment')->name('deleteComment');
    Route::get('/adminallProductsForSellNoCat', 'adminallProductsForSellNoCat')->name('adminallProductsForSellNoCat');
    Route::get('/allProductsForSellNoCat', 'allProductsForSellNoCat')->name('allProductsForSellNoCat');
});


Route::controller(usercontroller::class)->group(function () {
    Route::get('/homeUser', 'homeUser')->name('homeUser');
    Route::get('/userProfile', 'userProfile')->name('userProfile');
    Route::get('/userProfileEdit', 'userProfileEdit')->name('userProfileEdit');
    Route::post('/userProfileUpdate', 'userProfileUpdate')->name('userProfileUpdate');
    Route::get('/UserChangePassword', 'UserChangePassword')->name('UserChangePassword');
    Route::post('/UserUpdatePassword', 'UserUpdatePassword')->name('UserUpdatePassword');
    Route::get('/userAllProducts', 'userAllProducts')->name('userAllProducts');
    Route::get('/userEditProduct/{id}', 'userEditProduct')->name('userEditProduct');
    Route::post('/userProductUpdate', 'userProductUpdate')->name('userProductUpdate');
    Route::get('/addProduct', 'addProduct')->name('addProduct');
    Route::post('/productStore', 'productStore')->name('productStore');
    Route::get('/multiImageDelete/{id}', 'multiImageDelete')->name('multiImageDelete');
    Route::get('/userProductImages/{id}', 'userProductImages')->name('userProductImages');
    Route::post('/addMultiImage', 'addMultiImage')->name('addMultiImage');
    Route::get('/deleteProduct/{id}', 'deleteProduct')->name('deleteProduct');
    Route::post('/sellProduct', 'sellProduct')->name('sellProduct');
    Route::get('/userWallet', 'userWallet')->name('userWallet');
    Route::post('/walletRaise', 'walletRaise')->name('walletRaise');
    Route::get('/userallProductsForSell/{id}', 'userallProductsForSell')->name('userallProductsForSell');
    Route::get('/userProductShowAllComments/{id}', 'userProductShowAllComments')->name('userProductShowAllComments');
    Route::post('/userpostComment', 'userpostComment')->name('userpostComment');
    Route::post('/buyProduct', 'buyProduct')->name('buyProduct');
    Route::get('/userallProductsForSellNoCat', 'userallProductsForSellNoCat')->name('userallProductsForSellNoCat');
});
Route::controller(MasterHeadImageController::class)->group(function () {
    Route::get('/masterheadimage', 'masterheadimage')->name('masterheadimage');
    Route::post('/createMasterHead', 'createMasterHead')->name('createMasterHead');
    Route::get('/deletemasterhead/{id}', 'deletemasterhead')->name('deletemasterhead');
});
