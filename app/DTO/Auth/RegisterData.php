<?php

namespace App\DTO\Auth;

class RegisterData {

  public function __construct(

      public string $name,

      public string $email,

      public string $password,

      public string $password_confirmation) {}

}
