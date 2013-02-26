<?php
namespace Libs;

class Flickr implements Flickr\FlickrInterface {
    private $apiKey = '';
    private $parser = null;
    private $method = null;
    private $params = [];
    private $defaultAdditionalParams = [];
    private $defaultGate = 'http://api.flickr.com/services/rest/?';

    public function __construct(ParserInterface $parser = null) {
        if ($parser !== null) {
            $this->setParser($parser);
        }

        $this->defaultAdditionalParams = [
            'format' => 'json'
        ];

        return $this;
    }

    public function addParam($name, $value) {
        $this->params[$name] = $value;
    }

    public function setMethod($methodName) {
        $this->method = $methodName;
    }

    public function getResponse(array $params) {
        if ($this->parser === null) {
            return false;
        }

        if (count($this->defaultAdditionalParams) > 0) {
            foreach ($this->defaultAdditionalParams as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        $requestUrl = $this->defaultGate . $this->createRequestUrl($params);
        $rawResponse = file_get_contents($requestUrl);

        return $this->parser->parse($rawResponse);
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }

    public function setParser($parser) {
        $this->parser = $parser;

        return $this;
    }

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