<?php

namespace App;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Cart
{
    protected $items = [];
    private $hasCouponApplied = false;
    private $discountAmount;
    private $couponCodeApplied;
    /**
     * @var Coupon
     */
    private $coupon;

    public function __construct(Coupon $coupon) {
        $this->items = array();
        $this->coupon = $coupon;
    }

    public function isEmpty() : bool
    {
        return (empty($this->items));
    }

    public function addItem(Item $item) : void
    {
        $id = $item->getId();

        if (!$id) {
            throw new Exception('The cart requires items with unique ID values.');
        }

        if (isset($this->items[$id])) {
            // if item is already added, just update quantity
            $this->updateItem($item, $this->items[$id]['qty'] + 1);
        } else {
            // first item to be added
            $this->items[$id] = ['item' => $item, 'qty' => 1];
        }
    }

    public function getItems() : array
    {
        return $this->items;
    }

    public function totalItems() : int
    {
        $items = $this->getItems();

        $totalQuantity = 0;
        foreach ($items as $item) {
            $totalQuantity += $item['qty'];
        }

        return $totalQuantity;
    }

    public function updateItem(Item $item, $qty) : void
    {
        $id = $item->getId();

        $this->items[$id]['qty'] = $qty;
    }

    public function removeItem(Item $item) : void
    {
        $id = $item->getId();

        if (isset($this->items[$id])) {
            unset($this->items[$id]);
        }
    }

    public function getTotalAmount()
    {
        $total = 0;

        foreach ($this->items as $item) {
            $total += $item['item']->getPrice() * $item['qty'];
        }

        if($this->hasCouponApplied()) {
            return $total - $this->getDiscountAmount();
        }

        return $total;
    }

    public function applyCoupon($code) : void
    {
        if($this->hasCouponApplied()) {
            throw new \Exception("A Coupon has already been applied to this cart");
        }

        $coupon = $this->coupon->where('code', $code)->first();

        if(!$coupon) {
            throw new ModelNotFoundException("Coupon with the supplied code does not exist");
        }

        if($coupon->isApplicable($code, $this)) {
            $this->setDiscountAmount($coupon->discount($this));
            $this->setHasCouponApplied(true);
            $this->setCouponCodeApplied($code);
        }
    }

    public function setDiscountAmount($discount) : void
    {
        $this->discountAmount = $discount;
    }

    public function getDiscountAmount() : int
    {
        return $this->discountAmount;
    }

    public function hasCouponApplied() : bool
    {
        return $this->hasCouponApplied;
    }

    public function setHasCouponApplied($value) : void
    {
        $this->hasCouponApplied = $value;
    }

    public function setCouponCodeApplied($code) : void
    {
        $this->couponCodeApplied = $code;
    }

    public function getCouponCodeApplied() : ?string
    {
        return $this->couponCodeApplied;
    }
}
