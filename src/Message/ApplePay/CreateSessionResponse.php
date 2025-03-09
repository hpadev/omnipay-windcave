<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\CreateSessionResponse as GooglePayCreateSessionResponse;

class CreateSessionResponse extends GooglePayCreateSessionResponse
{
    public $linkRel = 'ajaxSubmitApplePay';

}
