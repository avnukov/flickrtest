<?php
namespace Libs;
/**
 * Class Flickr
 * @package Libs
 */
class Flickr implements Flickr\FlickrInterface {
    private $apiKey = '';
    private $parser = null;
    private $method = null;
    private $params = [];
    private $defaultAdditionalParams = [];
    private $defaultGate = 'http://api.flickr.com/services/rest/?';

    public function __construct() {
        $this->defaultAdditionalParams = [
            'format' => 'json'
        ];
    }

    /**
     * Add single param for futher request
     *
     * @param string $name
     * @param string $value
     */
    public function addParam($name, $value) {
        $this->params[$name] = $value;
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;
    }

    public function setParser($parser) {
        $this->parser = $parser;
    }

    /**
     * Set required Flickr API method
     *
     * @param Flickr\Method $methodName string
     */
    public function setMethod($methodName) {
        $this->method = $methodName;
    }

    /**
     * Get response by params from selected Flickr API method
     *
     * @param array $params
     * @return bool|mixed
     */
    public function getResponse(array $params) {
        // if parser wasn't defined we couldn't process this request
        if ($this->parser === null) {
            return false;
        }

        // add additionalParams to request params
        if (count($this->defaultAdditionalParams) > 0) {
            foreach ($this->defaultAdditionalParams as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        // create full request url - method+compiled params
        $requestUrl = $this->defaultGate . $this->createRequestUrl($params);
        // get response from Flickr API
        $rawResponse = file_get_contents($requestUrl);

        // return response parsed by defined parser
        return $this->parser->parse($rawResponse);
    }

    /**
     * Convert params from array to get string
     *
     * @param array $additionalParams
     * @return string
     */
    private function createRequestUrl(array $additionalParams = []) {
        $params = $this->params;

        if (count($additionalParams) > 0) {
            foreach ($additionalParams as $key => $value) {
                $params[$key] = $value;
            }
        }

        $params['method'] = $this->method;
        $params['api_key'] = $this->apiKey;

        return http_build_query($params);
    }
}