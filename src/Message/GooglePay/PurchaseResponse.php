<?php

namespace Omnipay\Windcave\Message\GooglePay;

use Omnipay\Windcave\Message\AbstractResponse;

// Example response with 3DSecure
// {
//     "id" : "000003000180269003b864d188e4f4da",
//     "links" : [
//         {
//             "href" : "https://uat.windcave.com/pxmi3/F2F18C78612982E850903743C2C5DCC15B316BE34551122054340E7FE5D60AD65EC09BD49A4D6EE052E917DB871F01BEA",
//             "rel" : "3DSecure",
//             "method" : "REDIRECT"
//         }
//     ]
// }
//
// Example response without 3DSecure
// {
//     "id": "00001200036244160cd3eed722903bc5",
//     "links": [
//         {
//             "href": "https://example.com/success?sessionId=00001200036244160cd3eed722903bc5",
//             "rel": "done",
//             "method": "REDIRECT"
//         }
//     ]
// }

class PurchaseResponse extends AbstractResponse
{
    public $linkRel = 'ajaxSubmitGooglePay';

    public function isSuccessful()
    {
        $code = $this->getHttpResponseCode();

        return (($code >= 200 && $code < 300) && $this->getSessionId());
    }

    public function getSessionId()
    {
        return $this->getData('id');
    }

    public function getMessage()
    {
        return $this->getStatus();
    }

    public function getRedirectUrl()
    {
        $result = null;
        $links = $this->getData('links');
        // foreach ($links as $link) {
        //     if ($link['rel'] === $this->linkRel) {
        //         $result = $link['href'];
        //         break;
        //     }
        // }

        // Just get the first one. See the example responses above.
        if (count($links) && isset($links[0]) && isset($links[0]['href'])) {
            $result = $links[0]['href'];
        }

        return $result;
    }
}
