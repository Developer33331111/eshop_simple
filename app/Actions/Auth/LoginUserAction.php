<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\DTO\auth\LoginData;
use App\Services\AuthService;
use App\DTO\Auth\LoginResponse;

class LoginUserAction
{

  public function __construct(private AuthService $authService) {}

  public function execute(LoginData $data): LoginResponse {

    $user = User::where('email', $data->email)->first();

    if( (!$user) || ( !Hash::check($data->password, $user->password)) ) {

      throw ValidationException::withMessages([
        'credentials' => ['Invalid email or password.']
      ]);

    }

    $token = $this->authService->createToken(

      $user,

      $data->device_name ?? 'api-token',

      $user->getPermissionNames()->toArray()

    );

    return new LoginResponse(
      token: $token,
      user: $user->only('id', 'name', 'email')
    );

  }

}
