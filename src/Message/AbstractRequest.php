<?php

namespace Omnipay\Windcave\Message;

/**
 * @link https://www.windcave.com.au/rest-docs/index.html
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /** @var string Endpoint URL */
    protected $endpoint = 'https://{{environment}}.windcave.com/api/v1';

    abstract public function getEndpoint();
    abstract public function getResponseClass();

    protected $extraRequestHeaders = [];
    public $responseRaw;
    public $isUnitTest = false;
    public $unitTestResponseJson;
    public $unitTestResponseHeaders;
    public $unitTestResponseStatusCode;

    protected function baseEndpoint()
    {
        return str_replace('{{environment}}', $this->getTestMode() ? 'uat' : 'sec', $this->endpoint);
    }

    protected function wantsJson()
    {
        return true;
    }

    /**
     * Get API publishable key
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     * Set API publishable key
     * @param  string $value API publishable key
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * Get Callback URLs associative array (approved, declined, cancelled)
     * @return array
     */
    public function getCallbackUrls()
    {
        return $this->getParameter('callbackUrls');
    }

    /**
     * Set Callback URLs associative array (approved, declined, cancelled)
     * @param array $value
     */
    public function setCallbackUrls($value)
    {
        return $this->setParameter('callbackUrls', $value);
    }

    /**
     * Get Merchant
     * @return string Merchant ID
     */
    public function getUsername()
    {
        return $this->getParameter('username');
    }

    /**
     * Set Merchant
     * @param  string $value Merchant ID
     */
    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getCurrency()
    {
        return $this->getParameter('currency');
    }

    public function setCurrency($value)
    {
        return $this->setParameter('currency', $value);
    }

    public function getMerchantReference()
    {
        return $this->getParameter('merchantReference');
    }

    public function setMerchantReference($value)
    {
        return $this->setParameter('merchantReference', $value);
    }

    abstract public function getContentType();

    public function setContentType($value)
    {
        return $this->setParameter('contentType', $value);
    }

    public function getType()
    {
        return $this->getParameter('type');
    }

    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

    public function getHttpMethod()
    {
        return $this->getParameter('httpMethod');
    }

    public function setHttpMethod($value)
    {
        return $this->setParameter('httpMethod', $value);
    }

    public function sendAuthHeader()
    {
        return true;
    }

    /**
     * Get request headers
     * @return array Request headers
     */
    public function getRequestHeaders()
    {
        // common headers
        $headers = array(
            'Content-Type' => $this->getContentType(),
        );

        if ($this->wantsJson()) {
            $headers['Accept'] = 'application/json';
        }

        if (is_array($this->extraRequestHeaders) && count($this->extraRequestHeaders)) {
            $headers = array_merge($headers, $this->extraRequestHeaders);
        }

        return $headers;
    }

    public function setExtraRequestHeaders(Array $extraRequestHeaders = [])
    {
        $this->extraRequestHeaders = $extraRequestHeaders;

        return $this;
    }

    public function getExtraRequestHeaders()
    {
        return $this->extraRequestHeaders;
    }

    public function setResponseRaw($data)
    {
        $this->responseRaw = $data;

        return $this;
    }

    public function getResponseRaw()
    {
        return $this->responseRaw;
    }

    public function setIsUnitTest($isUnitTest)
    {
        $this->isUnitTest = $isUnitTest;

        return $this;
    }

    public function getIsUnitTest()
    {
        return $this->isUnitTest;
    }

    public function setUnitTestResponseJson($json)
    {
        $this->unitTestResponseJson = $json;

        return $this;
    }

    public function getUnitTestResponseJson()
    {
        return $this->unitTestResponseJson;
    }

    public function setUnitTestResponseHeaders($array)
    {
        $this->unitTestResponseHeaders = $array;

        return $this;
    }

    public function getUnitTestResponseHeaders()
    {
        return $this->unitTestResponseHeaders;
    }

    public function setUnitTestResponseStatusCode($statusCode)
    {
        $this->unitTestResponseStatusCode = $statusCode;

        return $this;
    }

    public function getUnitTestResponseStatusCode()
    {
        return $this->unitTestResponseStatusCode;
    }

    /**
     * Send data request
     *
     * @param $body
     *
     * @return \Omnipay\Common\Message\ResponseInterface|\Omnipay\Windcave\Message\Response
     */
    public function sendData($body)
    {
        $responseClass = $this->getResponseClass();

        if ($this->isUnitTest()) {
            $data = $this->getUnitTestResponseJson();
            if ($this->wantsJson()) {
                $data = json_decode($data, true);
            }
        } else {
            $username = $this->getUsername();
            $apiKey = $this->getApiKey();

            $headers = $this->getRequestHeaders();
            if ($this->sendAuthHeader()) {
                $headers['Authorization'] = 'Basic ' . base64_encode($username . ':' . $apiKey);
            }
            // dump($headers, $body, $this->getHttpMethod(), $this->getEndpoint());
            // die();
            $response = $this->httpClient->createRequest(
                $this->getHttpMethod(),
                $this->getEndpoint(),
                $headers,
                $body
            )->send();

            $data = $response->getBody()->__toString();
            $this->setResponseRaw($data);

            if ($this->wantsJson()) {
                // $data = json_decode($data, true);
                $data = $response->json();
            }
        }

        $this->response = new $responseClass($this, $data);

        if ($this->isUnitTest()) {
            $this->response->setHttpResponseCode($this->getUnitTestResponseStatusCode());
            $this->response->setHeaders($this->getUnitTestResponseHeaders());
        } else {
            // save additional info
            $this->response->setHttpResponseCode($response->getStatusCode());
            $this->response->setHeaders($response->getHeaders()->toArray());
        }

        return $this->response;
    }

    public function isUnitTest()
    {
        return ($_SERVER['HTTP_USER_AGENT'] === 'CLI' && strstr($_SERVER['PHP_SELF'], 'phpunit'));
    }
}
