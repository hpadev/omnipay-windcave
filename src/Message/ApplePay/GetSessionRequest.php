<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\GetSessionRequest as GooglePayGetSessionRequest;

/**
 * @link https://px5.docs.apiary.io/#reference/0/sessions/query-session
 */
class GetSessionRequest extends GooglePayGetSessionRequest
{
    public function getResponseClass()
    {
        return GetSessionResponse::class;
    }
}
