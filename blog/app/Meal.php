<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
   
protected $fillable = [
        'Name', 'Photo', 'Description','QuantityInStock','BuyPrice','SalePrice',
    ];
}

