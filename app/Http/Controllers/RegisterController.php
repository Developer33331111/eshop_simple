<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RegisterRequest;
use App\Actions\Auth\RegisterUserAction;
use App\DTO\Auth\RegisterData;
use App\Http\Resources\UserLoginRegisterResource;

class RegisterController extends Controller
{

  public function register(RegisterRequest $request, RegisterUserAction $userRegisterAction) {

    $dtoRegisterData = new RegisterData(
      name: $request->validated('name'),
      email: $request->validated('email'),
      password: $request->validated('password'),
      password_confirmation: $request->validated('password_confirmation')
    );

    $response = $userRegisterAction->execute($dtoRegisterData);

    return response()->json([
      'data' => [
        'token' => $response->token,
        'user' => new UserLoginRegisterResource($response->user)
      ]
    ]);

  }

}
