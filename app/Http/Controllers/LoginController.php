<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUserAction;
use App\DTO\auth\LoginData;

class LoginController extends Controller
{

  public function login(LoginRequest $request, LoginUserAction $userLoginAction) {

    $userLoginActionDTO = new LoginData(
      email: $request->validated('email'),
      password: $request->validated('password'),
      deviceName: $request->validated('device_name')
    );

    return response()->json([
      $userLoginAction->execute($userLoginActionDTO)
    ]);

  }

}
