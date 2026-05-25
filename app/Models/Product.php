<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $fillable = [

    'code',
    'name',
    'seo_url',
    'price',
    'description'

  ];

}
