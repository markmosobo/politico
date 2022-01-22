<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;
use App\Http\Controllers\MpesaController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'event' => API\EventController::class,
    'news' => API\NewsController::class,
    'slide' => API\SlidesController::class,
    'about' => API\AboutController::class,
    'moreabout' => API\MoreAboutController::class,
    'biography' => API\BiographyController::class,
    'issue' => API\IssueController::class,
    'pledge' => API\PledgeController::class
]);
Route::get('tags',[API\TagController::class,'list']);
Route::get('event/{id}',[API\EventController::class,'previewEvent']);
Route::post('v1/access/token', [MpesaController::class,'generateAccessToken']);
Route::post('v1/hlab/stk/push', [MpesaController::class,'customerMpesaSTKPush']);
Route::post('v1/hlab/validation', [MpesaController::class,'mpesaValidation']);
Route::post('v1/hlab/transaction/confirmation', [MpesaController::class,'mpesaConfirmation']);