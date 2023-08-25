<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FederationController;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\FederationSyncController;
use App\Http\Controllers\FriderController;
use App\Http\Controllers\FeventController;
use App\Http\Controllers\SnpoolController;
use App\Http\Controllers\FentryControler;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LentryController;
use App\Http\Controllers\FhorseController;
use App\Http\Controllers\StationRecordsController;
use App\Http\Middleware\EnsureClientIsValid;
use App\Http\Middleware\EnsureClientIsFed;
use App\Models\Reusable;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return 'ping!';
});

Route::get('records', [StationRecordsController::class, 'index']);
Route::post('records', [StationRecordsController::class, 'createTmpRecord']);
Route::delete('records', [StationRecordsController::class, 'deleteRecord']);
