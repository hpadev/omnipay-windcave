<?php

namespace Omnipay\Windcave\Message\CreditCard;

use Omnipay\Windcave\Message\GooglePay\PurchaseResponse as GooglePayPurchaseResponse;

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

class PurchaseResponse extends GooglePayPurchaseResponse
{
    public $linkRel = 'ajaxSubmitCard';

}
