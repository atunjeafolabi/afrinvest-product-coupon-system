<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function add(Request $request)
    {
        $items = array_map(function($item){
            return new Item($item['id'], $item['name'], $item['price']);
        }, $request->input('items'));

        foreach ($items as $item) {
            $this->cart->addItem($item);
        }

        if($request->coupon_code) {
            $this->cart->applyCoupon($request->coupon_code);
        }

        $isCouponApplied = $this->cart->hasCouponApplied() ? 'Yes' : 'No';

        return response()->json([
            "is_coupon_applied" => $isCouponApplied,
            "coupon_code_applied" => $this->cart->getCouponCodeApplied(),
            "new_total_amount" => $this->cart->getTotalAmount()
        ]);
    }
}
