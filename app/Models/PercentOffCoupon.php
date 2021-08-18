<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentOffCoupon extends Model
{
    use HasFactory;

    public function discount($cart)
    {
        return ($this->percent_off / 100) * $cart->getTotalAmount();
    }
}
