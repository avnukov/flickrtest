<?php
namespace Libs;

class Flickr extends \Libs\Flickr\FlickrAbstract {
    private $apiKey = null;

    public function __construct() {
        return $this;
    }

    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }
}