<?php

namespace Omnipay\Windcave\Message\ApplePay;

use Omnipay\Windcave\Message\GooglePay\CreateTransactionRequest as GooglePayCreateTransactionRequest;

/**
 * @link https://www.windcave.com/developer-e-commerce-api-rest#stored_card_Tokens Create Transaction Rebill
 */
class CreateTransactionRequest extends GooglePayCreateTransactionRequest
{
    public function getResponseClass()
    {
        return CreateTransactionResponse::class;
    }
}
