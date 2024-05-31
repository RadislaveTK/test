<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workspace', [HomeController::class, 'showWorkspace'])->name('workspace');
Route::get('/workspace/{ws}', [HomeController::class, 'detailWorkspace'])->name('detail');

Route::get('/workspace/create', [HomeController::class, 'createWorkspace'])->name('ws.create');
Route::post('/workspace/store', [HomeController::class, 'storeWorkspace'])->name('ws.store');

Route::get('/workspace/{ws}/delete', [HomeController::class, 'deleteWorkspace'])->name('ws.delete');
