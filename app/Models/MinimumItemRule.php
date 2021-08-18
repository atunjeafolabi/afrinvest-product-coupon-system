<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinimumItemRule extends Model
{
    use HasFactory;

    public function apply($cart)
    {
        return $cart->totalItems() >= $this->value;
    }
}
