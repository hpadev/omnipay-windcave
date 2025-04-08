<?php

namespace Omnipay\Windcave\Message\CreditCard;

use Omnipay\Windcave\Message\GooglePay\RefundRequest as GooglePayRefundRequest;

class RefundRequest extends GooglePayRefundRequest
{
    public static $key = 'card';

    public function getResponseClass()
    {
        return RefundRequest::class;
    }
}
