<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\CreateSessionRequest as GooglePayCreateSessionRequest;

/**
 * @link https://px5.docs.apiary.io/#reference/0/sessions/create-session
 */
class CreateSessionRequest extends GooglePayCreateSessionRequest
{
    public function getResponseClass()
    {
        return CreateSessionResponse::class;
    }
}
