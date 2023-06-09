<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\SalesViewController;
use App\Http\Controllers\TeamTypes\TypesAdminController;
use App\Http\Controllers\TeamTypes\AddTeamTypeController;
use App\Http\Controllers\TeamTypes\DeleteTeamTypeHistory;
use App\Http\Controllers\TeamTypes\UpdateTeamTypeHistoryController;
use App\Http\Controllers\TeamTypes\UpdateTeamTypeController;
use App\Http\Controllers\OwnerGroups\OwnerGroupController;
use App\Http\Controllers\OwnerGroups\CreateGroupController;
use App\Http\Controllers\OwnerGroups\UpdateGroupController;

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

    Route::get('/personal-page/operations', [App\Http\Controllers\PersonalPage\SalesController::class, 'index'])
        ->name('personal-page.operations');

    Route::get('/types-admin', [TypesAdminController::class, 'index'])
        ->name('types-admin');

    Route::get('/add-team-type', [AddTeamTypeController::class, 'create'])
        ->name('add-team-type');

    Route::post('/store-team-type', [AddTeamTypeController::class, 'store'])
        ->name('store-team-type');
    
    Route::get('/delete-team-type-history/{id}', [DeleteTeamTypeHistory::class, 'destroy'])
        ->name('delete-team-type-history');

    Route::post('/update-team-type-history', [UpdateTeamTypeHistoryController::class, 'update'])
        ->name('update-team-type-history');

    Route::get('/update-team-type/{uuid}', [UpdateTeamTypeController::class, 'create'])
        ->name('update-team-type');

    Route::post('/update-team-type/{uuid}', [UpdateTeamTypeController::class, 'update'])
        ->name('update.update-team-type');
    
    Route::get('/communities-admin', [OwnerGroupController::class, 'create'])
        ->name('partners-admin');

    Route::get('/create-community', [CreateGroupController::class, 'create'])
        ->name('create-group');
    
    Route::post('/create-community', [CreateGroupController::class, 'store'])
        ->name('create-group.store');

    Route::get('/update-community/{uuid}', [UpdateGroupController::class, 'create'])
        ->name('update-community');
    
    Route::post('/update-community/{uuid}', [UpdateGroupController::class, 'update'])
        ->name('update-community.update');

    Route::get('/community/{uuid}', function ($uuid) {
        return $uuid;
    })->name('community');
});
