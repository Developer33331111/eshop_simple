<?php

namespace App\DTO\Auth;

class RegisterResponse {

  public function __construct(

      public string $token,

      public mixed $user

    ) {}

}
