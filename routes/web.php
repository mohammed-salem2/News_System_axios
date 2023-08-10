<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ViewerController;
use App\Models\AuthorController as ModelsAuthorController;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
Route::prefix('cms/')->middleware('guest:admin,author')->group(function(){
    Route::get('{guard}/login' , [UserAuthController::class , 'showLogin'])->name('view.login');
    Route::post('{guard}/login' , [UserAuthController::class , 'login']);
});

Route::prefix('cms/')->group(function(){
    Route::get('start' , [StartController::class , 'index'])->name('view.start');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function(){
Route::get('logout' , [UserAuthController::class , 'logout'])->name('view.logout');
});

Route::prefix('cms/admin/')->middleware('auth:admin,author')->group(function(){
    Route::view('test' , 'cms.template')->name('test');
    Route::view('temp' , 'cms.template');
    Route::resource('countries', CountryController::class);
    Route::post('countries-update/{id}' , [CountryController::class , 'update']);
    Route::resource('cities', CityController::class);
    Route::post('cities-update/{id}' , [CityController::class , 'update']);
    Route::resource('admins', AdminController::class);
    Route::get('dele', [AdminController::class , 'index_delete'])->name('admin.only');
    Route::get('restore/{id}', [AdminController::class , 'restore'])->name('admin.restore');
    Route::get('force/{id}', [AdminController::class , 'force_delete'])->name('admin.delete');
    Route::post('admins-update/{id}' , [AdminController::class , 'update']);
    Route::post('getCIties',[CityController::class,'getCities'])->name('getCities');
    Route::resource('authors', AuthorController::class);
    Route::post('authors-update/{id}' , [AuthorController::class , 'update']);
    Route::resource('categories', CategoryController::class);
    Route::post('categories-update/{id}' , [CategoryController::class , 'update']);
    Route::resource('articles', ArticleController::class);
    Route::post('articles-update/{id}' , [ArticleController::class , 'update']);

    Route::get('/create/articles/{id}', [ArticleController::class, 'createArticle'])->name('createArticle');
    Route::get('/index/articles/{id}', [ArticleController::class, 'indexArticle'])->name('indexArticle');

    Route::resource('comments', CommentController::class);

    Route::resource('viewers', ViewerController::class);
    Route::post('viewers-update/{id}' , [ViewerController::class , 'update']);

    Route::resource('sliders', SliderController::class);
    Route::post('sliders-update/{id}' , [SliderController::class , 'update']);

    Route::resource('permissions', PermissionController::class);
    Route::post('permissions-update/{id}' , [PermissionController::class , 'update']);

    Route::resource('roles', RoleController::class);
    Route::post('roles-update/{id}' , [RoleController::class , 'update']);

    Route::resource('roles.permissions', RolePermissionController::class);


});

