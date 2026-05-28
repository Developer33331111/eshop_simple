<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

      return [
        'id' => $this->id,
        'code' => $this->code,
        'name' => $this->name,
        'seo_url' => $this->seo_url,
        'price' => $this->price,
        'description' => $this->description,
        'parameters' => $this->whenLoaded('parameters', fn() =>
          $this->parameters->map(fn($param) => [
            'name' => $param->name,
            'value' => $param->value
          ])
        ),
        'created_at' => $this->description
      ];

    }
}
