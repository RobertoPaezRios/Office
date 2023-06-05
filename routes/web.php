<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesViewController;
use App\Http\Controllers\TeamTypes\TypesAdminController;
use App\Http\Controllers\TeamTypes\AddTeamTypeController;
use App\Http\Controllers\TeamTypes\DeleteTeamTypeHistory;
use App\Http\Controllers\TeamTypes\UpdateTeamTypeHistoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/price', function () {
    return view('price');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/operations', [SalesViewController::class, 'index'])
        ->name('operations');

    Route::get('/operation/{id}', [SaleController::class, 'display'])
        ->name('operation');

    Route::get('/types-admin', [TypesAdminController::class, 'index'] 
        )->name('types-admin');

    Route::get('/add-team-type', [AddTeamTypeController::class, 'create'])
        ->name('add-team-type');

    Route::post('/store-team-type', [AddTeamTypeController::class, 'store'])
        ->name('store-team-type');
    
    Route::get('/delete-team-type-history/{id}', [DeleteTeamTypeHistory::class, 'destroy'])
        ->name('delete-team-type-history');

    Route::post('/update-team-type-history', [UpdateTeamTypeHistoryController::class, 'update'])
        ->name('update-team-type-history');
});
