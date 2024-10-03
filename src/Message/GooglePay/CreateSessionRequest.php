<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Windcave\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;

/**
 * @link https://px5.docs.apiary.io/#reference/0/sessions/create-session
 */
class CreateSessionRequest extends AbstractRequest implements RequestInterface
{
    /**
     * @return string
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = [
            'type' => $this->getType(),
            'currency' => $this->getCurrency(),
            'merchantReference' => substr($this->getMerchantReference(), 0, 64),
            'callbackUrls' => $this->getCallbackUrls(),
        ];

        $params = $this->getParameters();
        if (isset($params['storeCard']) && ($params['storeCard'] === true)) {
            $data['storeCard'] = $params['storeCard'];
            $data['storedCardIndicator'] = $params['storedCardIndicator'];
            $data['recurringExpiry'] = $params['recurringExpiry'];
            $data['recurringFrequency'] = $params['recurringFrequency'];
        }

        // Has the Money class been used to set the amount?
        if ($this->getAmount() instanceof Money) {
            // Ensure principal amount is formatted as decimal string e.g. 50.00
            $data['amount'] = (new DecimalMoneyFormatter(new ISOCurrencies()))->format($this->getAmount());
        } else {
            $data['amount'] = $this->getAmount();
        }

        return json_encode($data);
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->baseEndpoint() . '/sessions';
    }

    public function getHttpMethod()
    {
        return 'POST';
    }

    public function getContentType()
    {
        return 'application/json';
    }

    public function getResponseClass()
    {
        return CreateSessionResponse::class;
    }

    public function setStoreCard($value)
    {
        return $this->setParameter('storeCard', $value);
    }

    public function getStoreCard()
    {
        return $this->getParameter('storeCard');
    }

    public function setStoredCardIndicator($value)
    {
        return $this->setParameter('storedCardIndicator', $value);
    }

    public function getStoredCardIndicator()
    {
        return $this->getParameter('storedCardIndicator');
    }

    public function setRecurringExpiry($value)
    {
        return $this->setParameter('recurringExpiry', $value);
    }

    public function getRecurringExpiry()
    {
        return $this->getParameter('recurringExpiry');
    }

    public function setRecurringFrequency($value)
    {
        return $this->setParameter('recurringFrequency', $value);
    }

    public function getRecurringFrequency()
    {
        return $this->getParameter('recurringFrequency');
    }
}
