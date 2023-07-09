<?php

use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\ProviderController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UserTransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return response()->json(
        [
            'AppName'=> config('app.name'),
            'Author' => config('app.author'),
            'AppVersion' => config('app.version')
        ]
        );
});
Route::get('unauthorized', [RegisterController::class, 'unauthorized'])->name('unauthorized');
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {

    // Logout
    Route::post('logout', [RegisterController::class, 'logout']);

    // Users
    Route::resource('/users', UserController::class);

    //  Bank Transfer Providers
    Route::resource('providers', ProviderController::class);
    Route::get('/provider/{id}/banks', [ProviderController::class, 'banksByProvider']);


    // User Transactions
    Route::put('/transfer/user', [UserTransactionController::class, 'userTransfer']);
    Route::put('/transfer/bank', [UserTransactionController::class, 'bankTransfer']);

});
// Banks
Route::resource('banks', BankController::class);

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:cache');

    return json_encode("Cleared!");
});