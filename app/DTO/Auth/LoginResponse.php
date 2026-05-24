<?php

namespace App\DTO\Auth;

class LoginResponse {

  public function __construct(

      public string $token,

      public mixed $user

    ) {}

}
