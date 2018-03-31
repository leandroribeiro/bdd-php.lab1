<?php
/**
 * Created by PhpStorm.
 * User: Leandro
 * Date: 31-Mar-18
 * Time: 14:54
 */

final class Shelf
{
    private $priceMap = array();

    public function setProductPrice($product, $price)
    {
        $this->priceMap[$product] = $price;
    }

    public function getProductPrice($product)
    {
        return $this->priceMap[$product];
    }
}