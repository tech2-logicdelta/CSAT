<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Salesrepresentative;
use App\Models\store;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\API\UserController::class,'login']);

Route::group(['middleware' => ['auth:api']], function(){
  Route::get('/store-list', function (Request $request) {
    if ($request->user()) {
      $store = Store::orderBy('created_at', 'desc')->get();
      return response()->json(['status' => 'success', 'code' => 200, 'message' => '', 'result' => $store]);
    } else {
      return response()->json(['status' => 'error', 'code' => 401, 'message' => 'Unauthenticated', 'result' => []], 401);
    }
  });
  Route::get('/getSales-reprentative-list', function (Request $request) {
    if ($request->user()) {
      $salesReprentative = User::select('id','name','email','mobile','user_type','emp_code','doj')->with('UserType')->where('user_type','3')->get();
      return response()->json(['status' => 'success', 'code' => 200, 'message' => '', 'result' => $salesReprentative]);
    } else {
      return response()->json(['status' => 'error', 'code' => 401, 'message' => 'Unauthenticated', 'result' => []], 401);
    }
  });
  Route::post('add-user', [\App\Http\Controllers\API\UserController::class,'addUser']);
});
