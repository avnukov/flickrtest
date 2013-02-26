<?php
namespace Libs\Flickr;

/**
 * Class FlickrInterface
 * @package Libs\Flickr
 */
interface FlickrInterface {

    /**
     * @param $methodName Method from Flickr API for request
     */
    public function setMethod($methodName);

    /**
     * @param $name Name of param which will be added to request
     * @param $value Param value
     */
    public function addParam($name, $value);

    /**
     * @param array $params Additional params
     * @return mixed
     */
    public function getResponse(array $params);

}