<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;

class LoginControllerBackup extends Controller
{

  public function login(LoginRequest $request) {

    $user = User::where('email', $request->email)->first();

    if( (!$user) || ( !Hash::check($request->password, $user->password)) ) {

      throw ValidationException::withMessages([
        'credentials' => ['Invalid email or password.']
      ]);

    }

    $token = $user->createToken(

      $request->device_name ?? 'api-token',

      $user->getPermissionNames()->toArray()

    );

    return response()->json([
      'token' => $token->plainTextToken,
      'user' => $user->only('id', 'name', 'email')
    ]);

  }

}
