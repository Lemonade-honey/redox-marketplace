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

    /**
     * Summary of createOrderPayment
     * 
     * membuat sebuah payment order terikat beserta bill payment
     * @param \App\Models\Order $order
     * @return \App\Models\Payment
     */
    function createOrderPayment(\App\Models\Order $order): \App\Models\Payment;
}