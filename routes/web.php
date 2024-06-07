<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workspace', [HomeController::class, 'showWorkspace'])->name('workspace');

Route::get('/bills', [HomeController::class, 'showBills'])->name('bills');
Route::get('/bills/pay', function () {
    foreach (Auth::user()->workspaces()->latest()->get() as $ws) {
        foreach ($ws->apiTokens()->get() as $api) {
            $api->time = 0;
            $api->revoked_at = null;
            $api->save();
        }
    }
    return redirect()->route('bills');
})->name('bills.pay');

Route::get('/workspace/create', [HomeController::class, 'createWorkspace'])->name('ws.create');
Route::post('/workspace/store', [HomeController::class, 'storeWorkspace'])->name('ws.store');

Route::get('/workspace/{ws}', [HomeController::class, 'detailWorkspace'])->name('detail');

Route::get('/workspace/{ws}/delete', [HomeController::class, 'deleteWorkspace'])->name('ws.delete');

Route::get('/workspace/{ws}/createApi', [HomeController::class, 'createApi'])->name('ws.createApi');
Route::post('/workspace/{ws}/store', [HomeController::class, 'storeApi'])->name('ws.storeApi');

Route::get('/workspace/{ws}/api/{ap}', [TokenController::class, 'viewToken'])->name('api.view');

Route::get('/workspace/{ws}/api/{ap}/remove', [HomeController::class, 'removeApi'])->name('ws.removeApi');

Route::fallback([HomeController::class, 'notpage']);

