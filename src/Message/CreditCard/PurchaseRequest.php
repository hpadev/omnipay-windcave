<?php

namespace Omnipay\Windcave\Message\CreditCard;

use Omnipay\Windcave\Message\GooglePay\PurchaseRequest as GooglePayPurchaseRequest;

class PurchaseRequest extends GooglePayPurchaseRequest
{
    public static $key = 'card';

    public function getResponseClass()
    {
        return PurchaseResponse::class;
    }
}
