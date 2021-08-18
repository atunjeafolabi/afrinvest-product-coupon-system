<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MixedCoupon extends Model
{
    use HasFactory;

    public function discount($cart)
    {
        $percentOffValue = ($this->percent_off / 100) * $cart->getTotalAmount();

        return ($percentOffValue > $this->value ? $percentOffValue : $this->value);
    }
}
