<?php

namespace Omnipay\Windcave;

use Omnipay\Windcave\Message\CreditCard\PurchaseRequest;
use Omnipay\Windcave\Message\CreditCard\CreateSessionRequest;
use Omnipay\Windcave\Message\CreditCard\GetSessionRequest;
use Omnipay\Windcave\Message\CreditCard\RefundRequest;
use Omnipay\Windcave\Message\CreditCard\CreateTransactionRequest;

class CreditCardGateway extends Gateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName()
    {
        return 'Windcave Credit Card REST API';
    }

    /**
     * Get gateway short name
     *
     * This name can be used with GatewayFactory as an alias of the gateway class,
     * to create new instances of this gateway.
     * @return string
     */
    public function getShortName()
    {
        return 'WindcaveCreditCard';
    }

    /**
     * Purchase request
     *
     * @param array $parameters
     * @return \Omnipay\Windcave\Message\CreditCard\PurchaseRequest|\Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest(PurchaseRequest::class, $parameters);
    }

    /**
     * Create sessionId
     *
     * @param array $parameters
     * @return \Omnipay\Windcave\Message\CreditCard\CreateSessionRequest|\Omnipay\Common\Message\AbstractRequest
     */
    public function createSession(array $parameters = array())
    {
        return $this->createRequest(CreateSessionRequest::class, $parameters);
    }

    /**
     * Create sessionId with a CreditCard
     *
     * @param array $parameters
     * @return \Omnipay\Windcave\Message\CreditCard\GetSessionRequest|\Omnipay\Common\Message\AbstractRequest
     */
    public function getSession(array $parameters = array())
    {
        return $this->createRequest(GetSessionRequest::class, $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest(RefundRequest::class, $parameters);
    }

    public function createTransaction(array $parameters = array())
    {
        return $this->createRequest(CreateTransactionRequest::class, $parameters);
    }
}
