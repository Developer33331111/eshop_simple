<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUserAction;
use App\DTO\Auth\LoginData;
use App\Http\Resources\UserLoginRegisterResource;

class LoginController extends Controller
{

  public function login(LoginRequest $request, LoginUserAction $userLoginAction) {

    $dtoLoginData = new LoginData(
      email: $request->validated('email'),
      password: $request->validated('password'),
      deviceName: $request->validated('device_name')
    );

    $response = $userLoginAction->execute($dtoLoginData);

    return response()->json([
      'data' => [
        'token' => $response->token,
        'user' => new UserLoginRegisterResource($response->user)
      ]
    ]);

  }

}
