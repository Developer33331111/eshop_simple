<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUserAction;
use App\DTO\Auth\LoginData;

class LoginController extends Controller
{

  public function login(LoginRequest $request, LoginUserAction $userLoginAction) {

    $userLoginActionDTO = new LoginData(
      email: $request->validated('email'),
      password: $request->validated('password'),
      deviceName: $request->validated('device_name')
    );

    $response = $userLoginAction->execute($userLoginActionDTO);

    return response()->json(
      $response
    );

  }

}
