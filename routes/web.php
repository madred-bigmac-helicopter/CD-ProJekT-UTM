<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
require __DIR__ . '/auth.php';

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', function () {
        return redirect('/admin/task');
    })->name('admin');

    Route::post('/users', [UserController::class, 'index'])->name('users.table');
    Route::get('/user',function (){
        return view('admin.users.index');
    })->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/update', [RoleController::class, 'update'])->name('roles.update');
    Route::post('/roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.delete');

    Route::post('/tasks', [TaskController::class, 'index']);
    Route::get('/task', function (){
        return view('admin.tasks.index');
    })->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('/task/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::get('/task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect']
    ], function () {
    Route::get('/', function () {
        return view('about.about');
    });
    Route::get('/practice',[\App\Http\Controllers\TaskController::class, 'index'])->name('task-index');
    Route::post('/practice/group',[\App\Http\Controllers\TaskController::class, 'group'])->name('task-group');
    Route::post('/practice/modal/{id}',[\App\Http\Controllers\TaskController::class, 'modal'])->name('task-modal');
    Route::post('/practice/submit/{flag}/{id}',[\App\Http\Controllers\TaskController::class, 'submit'])->name('task-modal');
//    Route::get('/practice/task',[\App\Http\Controllers\TaskController::class,'show'])->name('task-show');
//    Route::post('/table',[UserController::class, 'index']);
//    Route::get ( '/test1', function () {
//        $data = \App\Models\User::all ();
//        return view ( 'admin.test1' )->withData( $data );
//    } );
});
