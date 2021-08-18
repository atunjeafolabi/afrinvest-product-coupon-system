<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    public function coupon()
    {
        return $this->morphTo();
    }

    public function isApplicable($code, $cart)
    {
        $rules = $this->rules()->where('coupon_id', $this->id)->get();

        foreach($rules as $rule) {
            if(!$rule->apply($cart)){
                return false;
            }
        }

        return true;
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function discount($cart)
    {
        return $this->coupon->discount($cart);
    }
}
