<?php

namespace Omnipay\Windcave\Message\CreditCard;

use Omnipay\Windcave\Message\GooglePay\CreateSessionResponse as GooglePayCreateSessionResponse;

class CreateSessionResponse extends GooglePayCreateSessionResponse
{
    public $linkRel = 'ajaxSubmitCard';

}
