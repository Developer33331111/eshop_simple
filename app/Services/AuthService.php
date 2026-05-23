<?php

namespace App\Services;

use App\Models\User;

class AuthService {

  public function createToken(User $user, string $deviceName, array $abilities = []): string {

    return $user->createToken($deviceName, $abilities)->plainTextToken;

  }

}
