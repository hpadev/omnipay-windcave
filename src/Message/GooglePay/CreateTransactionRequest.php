<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Money;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Windcave\Message\AbstractRequest;
use Omnipay\Common\Message\RequestInterface;

/**
 * @link https://www.windcave.com/developer-e-commerce-api-rest#stored_card_Tokens Create Transaction Rebill
 */
class CreateTransactionRequest extends AbstractRequest implements RequestInterface
{
    /**
     * @return string
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $params = $this->getParameters();
        $data = [
            'type' => $this->getType(),
            'currency' => $this->getCurrency(),
            'merchantReference' => substr($this->getMerchantReference(), 0, 64),
            'cardId' => $params['cardId'],
            'storedCardIndicator' => $params['storedCardIndicator'],
        ];

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
        return $this->baseEndpoint() . '/transactions';
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
        return CreateTransactionResponse::class;
    }

    public function setCardId($value)
    {
        return $this->setParameter('cardId', $value);
    }

    public function setStoredCardIndicator($value)
    {
        return $this->setParameter('storedCardIndicator', $value);
    }
}
