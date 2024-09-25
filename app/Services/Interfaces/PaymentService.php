<?php

namespace App\Services\Interfaces;

interface PaymentService
{
    /**
     * Summary of getMyBalance
     * 
     * get my balance amount
     * @return int
     */
    function getMyBalance(): int;

    /**
     * Summary of createBill
     * 
     * membuat sebuah bill payment
     * 
     * `require datas` ["title", "amount", "sender_name", "sender_email"]
     * @param array $datas
     * @return mixed
     */
    function createBill(array $datas): mixed;

    /**
     * Summary of getAllBills
     * 
     * mengambil semua bill yang telah dibuat
     * @return mixed
     */
    function getAllBills(): mixed;

    /**
     * Summary of getBill
     * 
     * get data bills
     * @param int $billId
     * @return mixed
     */
    function getBill(int $billId): mixed;

    /**
     * Summary of getAllPayments
     * 
     * allow parameters querys
     * 1. start_date => format YYYY-MM-DD
     * 2. end_date
     * 3. pagination
     * 4. page
     * 5. sort_by => id, bill_link, bill_title, sender_bank, amount, created_at
     * 6. sort_type => sort_desc, sort_asc
     * 
     * @param array $parameters
     * @return mixed
     */
    function getAllPayments(array $parameters = null): mixed;


    /**
     * Summary of mappingValidateCallback
     * 
     * mengecek request callback, apakah valid atau tidak,
     * membalikan requesst collect
     * @param \Illuminate\Http\Request $request
     * @return bool|\Illuminate\Support\Collection
     */
    function mappingValidateCallback(\Illuminate\Http\Request $request): bool|\Illuminate\Support\Collection;
}