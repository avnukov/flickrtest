<?php
namespace Libs\Flickr;

interface FlickrInterface {

    public function setMethod($methodName);
    public function addParam($name, $value);
    public function getResponse(Array $params);

}