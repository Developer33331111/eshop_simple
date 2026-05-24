<?php

namespace App\DTO\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResponse {

  public function __construct(

      public string $token,

      public JsonResource $user

    ) {}

}
