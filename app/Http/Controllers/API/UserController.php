<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Validator;

class UserController extends Controller
{
  public $successStatus = 200;
  /**
   * login api
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $data['id'] = $user->id;
      $data['name'] = $user->name;
      $data['token'] =  $user->createToken('MyApp')->accessToken;
      return response()->json([
        'status' => 'success',
        'code' => 200,
        'message' => 'Login successful',
        'result' => $data,
      ], 200);
    } else {
      return response()->json([
        'status' => 'error',
        'code' => 400,
        'message' => 'Creditional Are invalid',
        'result' => [],
      ], 400);
    }
  }

  public function addUser(Request $request)
  {
    try {
      $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|unique:users|regex:/^[0-9]{10}$/'
      ]);

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->mobile = $request->mobile;
      $user->user_type = '4';
      $user->save();

      $data['user_type'] = $user->user_type;
      $data['id'] = $user->id;
      return response()->json([
        'status' => 'success',
        'code' => 200,
        'message' => 'Add User Successfully',
        'result' => $data,
      ], 200);
    } catch (ValidationException $e) {
      return response()->json([
        'status' => 'error',
        'code' => 400,
        'message' => 'Validation error',
        'result' => $e->validator->errors(),
      ], 400);
    }
  }
}
