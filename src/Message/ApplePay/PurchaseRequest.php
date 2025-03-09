<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\PurchaseRequest as GooglePayPurchaseRequest;

class PurchaseRequest extends GooglePayPurchaseRequest
{
    public static $key = 'applePay';

    public function getResponseClass()
    {
        return PurchaseResponse::class;
    }
}
