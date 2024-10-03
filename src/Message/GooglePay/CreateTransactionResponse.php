<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Omnipay\Windcave\Message\AbstractResponse;

class CreateTransactionResponse extends AbstractResponse
{
    /**
     * Is the transaction successful?
     * @return boolean True if successful
     */
    public function isSuccessful()
    {
        // get response code
        $code = $this->getHttpResponseCode();

        return (($code >= 200 && $code < 300) && $this->getId() && $this->getResponseText() === 'APPROVED');
    }

    public function isPending()
    {
        return false;
    }

    public function getId()
    {
        return $this->getData('id');
    }

    public function getResponseText()
    {
        return $this->getData('responseText');
    }
}
