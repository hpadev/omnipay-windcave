<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Omnipay\Windcave\Message\AbstractResponse;

class RefundResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        $code = $this->getHttpResponseCode();

        $success = false;
        if ($code >= 200 && $code < 300) {
            if ($this->getData('type') === 'refund') {
                if ($this->getData('id')) {
                    if ($this->getData('responseText') === 'APPROVED' || $this->getData('responseText') === 'ALREADY REFUNDED') {
                        $success = true;
                    }
                }
            }
        }

        return $success;
    }

    public function getMessage()
    {
        $message = 'Type: ' . $this->getData('type') . ' | ResponseText: ' . $this->getData('responseText');

        return $message;
    }

}
