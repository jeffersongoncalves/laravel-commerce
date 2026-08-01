<?php

namespace JeffersonGoncalves\Commerce\Cart\Services;

use JeffersonGoncalves\Commerce\Cart\Models\Cart;
use JeffersonGoncalves\Commerce\Cart\Models\CartLineItem;
use JeffersonGoncalves\Commerce\Core\Services\Service;

class CartService extends Service
{
    protected function model(): string
    {
        return Cart::class;
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function addLineItem(string $cartId, array $attributes): CartLineItem
    {
        /** @var Cart $cart */
        $cart = $this->retrieve($cartId);

        return $cart->items()->create($attributes);
    }
}
