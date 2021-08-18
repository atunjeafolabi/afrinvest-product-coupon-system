<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    public function rule()
    {
        return $this->morphTo();
    }

    public function apply($cart)
    {
        return $this->rule->apply($cart);
    }
}
