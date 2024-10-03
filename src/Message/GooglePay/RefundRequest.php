<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Windcave\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;

class RefundRequest extends AbstractRequest implements RequestInterface
{
    public static $key = 'googlePay';

    public function getData()
    {
        $data = [
            'type' => $this->getType(),
            'currency' => $this->getCurrency(),
            'amount' => $this->getAmount(),
            'transactionId' => $this->getTransactionId(),
            'merchantReference' => $this->getMerchantReference(),
        ];

        return json_encode($data);
    }

    public function getEndpoint()
    {
        return $this->baseEndpoint() . '/transactions';
    }

    public function getContentType()
    {
        return 'application/json';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    protected function wantsJson()
    {
        return true;
    }

    public function sendAuthHeader()
    {
        return true;
    }

    public function getResponseClass()
    {
        return RefundResponse::class;
    }
}
