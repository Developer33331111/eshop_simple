<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductParameter extends Model
{

  protected $fillable = [

    'product_id',
    'name',
    'value'

  ];

}
