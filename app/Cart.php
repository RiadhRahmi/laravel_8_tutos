<?php

namespace App;

class Cart
{

    protected $items = [];

    // insert item in cart
    public function insert($item)
    {

        $this->items[] = $item;
    }

    // count items
    public function count()
    {
        return count($this->items);
    }

    // get list of items
    public function getItems()
    {
        return $this->items;
    }

    // calculate the total amount
    public function total()
    {
        $amount = 0;

        foreach ($this->items as $item) {
            $amount += $item['price'] * $item['qty'];
        }

        return $amount;
    }
}
