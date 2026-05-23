<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\DTO\auth\LoginData;

class LoginUserAction
{

  public function execute(LoginData $data): array {

    $user = User::where('email', $data->email)->first();

    if( (!$user) || ( !Hash::check($data->password, $user->password)) ) {

      throw ValidationException::withMessages([
        'credentials' => ['Invalid email or password.']
      ]);

    }

    $token = $user->createToken(

      $data->device_name ?? 'api-token',

      $user->getPermissionNames()->toArray()

    );

    return [
      'token' => $token->plainTextToken,
      'user' => $user->only('id', 'name', 'email')
    ];

  }

}
