<?php

namespace App\DTO\Auth;

class LoginData {

  public function __construct() {

    public string $email,

    public string $password,

    public ?string $deviceName = null

  }

}
