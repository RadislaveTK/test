<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workspace', [HomeController::class, 'showWorkspace'])->name('workspace');

Route::get('/bills', [HomeController::class, 'showBills'])->name('bills');
Route::get('/bills/pay', function () {
    foreach (Auth::user()->workspaces()->latest()->get() as $ws) {
        foreach ($ws->apiTokens()->get() as $api) {
            $api->time = 0;
            $api->blocking = false;
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

Route::middleware('admin')->group(function () {
    Route::get('/adminpanel', [AdminController::class, 'viewPanel'])->name('admin.panel');

    Route::post('/adminpanel/editConfigurate', [AdminController::class, 'editConfig'])->name('admin.editConfigurate');

    Route::get('/adminpanel/editUser/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/adminpanel/storeUser', [AdminController::class, 'storeUser'])->name('admin.storeUser');

    Route::get('/adminpanel/editWs/{ws}', [AdminController::class, 'editWs'])->name('admin.editWs');
    Route::post('/adminpanel/storeWs', [AdminController::class, 'storeWs'])->name('admin.storeWs');
});

Route::fallback([HomeController::class, 'notpage']);

