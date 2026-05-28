<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

  use HasFactory;

  protected $fillable = [

    'code',
    'name',
    'seo_url',
    'price',
    'description'

  ];

  public function parameters() {

    return $this->hasMany(ProductParameter::class);

  }

}
