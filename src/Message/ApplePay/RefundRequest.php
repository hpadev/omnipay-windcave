<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\RefundRequest as GooglePayRefundRequest;

class RefundRequest extends GooglePayRefundRequest
{
    public static $key = 'applePay';

    public function getResponseClass()
    {
        return RefundResponse::class;
    }
}
