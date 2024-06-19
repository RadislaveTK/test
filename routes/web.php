<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/loginapi/x-api-token={token}', [App\Http\Controllers\LoginTokenController::class, 'login'])->name('api.login');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workspace', [HomeController::class, 'showWorkspace'])->name('workspace');

Route::get('/bills', [HomeController::class, 'showBills'])->name('bills');
Route::get('/bills/pay', function () {
    foreach (Auth::user()->workspaces()->latest()->get() as $ws) {
        foreach ($ws->apiTokens()->get() as $api) {
            $ws->total = 0; 
            $api->time = 0;
            $api->blocking = false;
            $api->save();
            $ws->save();
        }
    }
    return redirect()->route('bills');
})->name('bills.pay');

Route::get('/workspace/create', [HomeController::class, 'createWorkspace'])->name('ws.create');
Route::post('/workspace/store', [HomeController::class, 'storeWorkspace'])->name('ws.store');

Route::get('/workspace/{ws}', [HomeController::class, 'detailWorkspace'])->name('detail');
Route::get('/workspace/{ws}/settings', [HomeController::class, 'settingsWorkspace'])->name('settings');
Route::post('/workspace/{ws}/settings', [HomeController::class, 'settingsSWorkspace'])->name('settingsS');

Route::get('/workspace/{ws}/delete', [HomeController::class, 'deleteWorkspace'])->name('ws.delete');

Route::get('/workspace/{ws}/createApi', [HomeController::class, 'createApi'])->name('ws.createApi');
Route::post('/workspace/{ws}/store', [HomeController::class, 'storeApi'])->name('ws.storeApi');

Route::get('/workspace/{ws}/api/{ap}/remove', [HomeController::class, 'removeApi'])->name('ws.removeApi');

Route::middleware('admin')->group(function () {
    Route::get('/adminpanel', [AdminController::class, 'viewPanel'])->name('admin.panel');

    Route::get('/adminpanel/editUser/{user}', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::post('/adminpanel/storeUser', [AdminController::class, 'storeUser'])->name('admin.storeUser');

    Route::get('/adminpanel/editWs/{ws}', [AdminController::class, 'editWs'])->name('admin.editWs');
    Route::post('/adminpanel/storeWs', [AdminController::class, 'storeWs'])->name('admin.storeWs');
});

Route::get('/api/{ap}', [TokenController::class, 'viewToken'])->name('api.view');

Route::fallback([HomeController::class, 'notpage']);



