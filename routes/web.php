<?php

use App\Http\Controllers\userblog\Blogcontroller;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Auth;
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



Route::get('/', [Blogcontroller::class, 'welcome']);

Route::group(['middleware' => "auth"], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('auth.dashboard');
});

Auth::routes();

// Route::get('frontend', [HomeController::class, 'frontend'])->name('crud.frontend');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Auth::routes();

Route::get('home', [HomeController::class, 'display'])->name('auth.display');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', Rolecontroller::class);
    Route::resource('users', userController::class);
    Route::resource('categories', CategoryController::class);
});

Route::get('category', [CategoryController::class, 'category'])->name('crud.category');
Route::post('addcategory', [CategoryController::class, 'addcategory'])->name('crud.insert');
Route::post('deletecategory', [CategoryController::class, 'deleteform'])->name('crud.delete');
Route::post('editcategory', [CategoryController::class, 'editcategory'])->name('crud.edit');

Route::get('blog', [Blogcontroller::class, 'ublog'])->name('crud.blog');
Route::post('addblog', [Blogcontroller::class, 'addblog'])->name('crud.bloginsert');
Route::get('viewblog', [Blogcontroller::class, 'viewblog'])->name('crud.viewblog');
Route::post('blogedit', [Blogcontroller::class, 'blogedit'])->name('crud.blogedit');
Route::post('blogupdate', [Blogcontroller::class, 'blogupdate'])->name('crud.blogupdate');
Route::post('blogdelete', [Blogcontroller::class, 'blogdelete'])->name('crud.blogdelete');
Route::post('bloglike', [Blogcontroller::class, 'bloglike'])->name('crud.bloglike');
Route::post('addcomment', [Blogcontroller::class, 'addcomment'])->name('crud.addcomment');
Route::post('viewcomment', [Blogcontroller::class, 'viewcomment'])->name('crud.viewcomment');
Route::post('dltcomment', [Blogcontroller::class, 'dltcomment'])->name('crud.dltcomment');
Route::post('multilike', [Blogcontroller::class, 'multilike'])->name('crud.multilike');
Route::post('multiviewcomment', [Blogcontroller::class, 'multiviewcomment'])->name('crud.multiviewcomment');
Route::post('commentedit', [Blogcontroller::class, 'commentedit'])->name('crud.commentedit');
Route::post('commentupdate', [Blogcontroller::class, 'commentupdate'])->name('crud.commentupdate');
Route::post('deletespecificcomment', [Blogcontroller::class, 'deletespecificcomment'])->name('crud.deletespecificcomment');
Route::post('editspecificcomment', [Blogcontroller::class, 'editspecificcomment'])->name('crud.editspecificcomment');
Route::post('updatespecificcomment', [Blogcontroller::class, 'updatespecificcomment'])->name('crud.updatespecificcomment');
Route::get('showcomment/{id}', [Blogcontroller::class, 'showcomment'])->name('crud.showcomment');
Route::get('displaycomment/{id}', [Blogcontroller::class, 'displaycomment'])->name('crud.displaycomment');



// Route::get('showallblog', [Blogcontroller::class, 'showallblog'])->name('crud.showallblog');
