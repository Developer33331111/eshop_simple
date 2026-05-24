<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\DTO\Auth\RegisterData;
use App\Services\AuthService;
use App\DTO\Auth\RegisterResponse;
use App\Http\Resources\UserLoginRegisterResource;

class RegisterUserAction
{

  public function __construct(private AuthService $authService) {}

  public function execute(RegisterData $data): RegisterResponse {

    return DB::transaction(function() use ($data) {

      $user = User::create([

        'name' => $data->name,

        'email' => $data->email,

        'password' => Hash::make($data->password)

      ]);

      $user->assignRole('User');

      $token = $this->authService->createToken(

        $user,

        $data->deviceName ?? 'api-token',

        $user->getPermissionNames()->toArray()

      );

      return new RegisterResponse(
        token: $token,
        user: new UserLoginRegisterResource($user)
      );

    });

  }

}
