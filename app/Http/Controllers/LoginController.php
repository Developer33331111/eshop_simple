<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Actions\Auth\LoginUserAction;

class LoginController extends Controller
{

  public function login(LoginRequest $request, LoginUserAction $userLoginAction1) {

    return response()->json([
      $userLoginAction1->execute($request->validated())
    ]);

  }

}
