<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\DTO\Auth\RegisterData;
use App\Services\AuthService;
use App\DTO\Auth\RegisterResponse;

class RegisterUserAction
{

  public function __construct(private AuthService $authService) {}

  public function execute(RegisterData $data): RegisterResponse {

    $user = User::create([

      'name' => $data->name,

      'email' => $data->email,

      'password' => Hash::make($data->password)

    ]);

    Role::create(['name' => 'User']);

    $user->assignRole('User');

    if( (!$user) || ( !Hash::check($data->password, $user->password)) ) {

      throw ValidationException::withMessages([
        'credentials' => ['Invalid email or password.']
      ]);

    }

    $token = $this->authService->createToken(

      $user,

      $data->deviceName ?? 'api-token',

      $user->getPermissionNames()->toArray()

    );

    return new RegisterResponse(
      token: $token,
      user: $user->only('id', 'name', 'email')
    );

  }

}
