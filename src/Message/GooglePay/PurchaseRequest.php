<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Windcave\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;

class PurchaseRequest extends AbstractRequest implements RequestInterface
{
    public static $key = 'googlePay';

    public function getData()
    {
        $data = [
            static::$key => $this->getPayData(),
        ];

        return json_encode($data);
    }

    public function getEndpoint()
    {
        return $this->getParameter('endpoint');
    }

    public function setEndpoint($value)
    {
        $this->setParameter('endpoint', $value);
    }

    public function getPayData()
    {
        return $this->getParameter(static::$key);
    }

    public function setPayData($value)
    {
        $this->setParameter(static::$key, $value);
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
        return false;
    }

    public function getResponseClass()
    {
        return PurchaseResponse::class;
    }
}
