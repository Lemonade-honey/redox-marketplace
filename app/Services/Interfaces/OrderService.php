<?php

namespace App\Services\Interfaces;

interface OrderService
{
    /**
     * Summary of mappingOrderProducts
     * 
     * mapping product dari cart user
     * @param array $carts
     * @return array|bool
     */
    function mappingOrderProducts(array $carts): array|bool;

}