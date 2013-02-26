<?php
namespace Libs\Flickr;
/**
 * Interface FlickrParserInterface
 * @package Libs\Flickr
 */
interface FlickrParserInterface {
    /**
     * @param $string Raw response from Flickr
     * @param bool $assoc If true then result should returned as associative array
     * @return mixed
     */
    public function parse($string, $assoc = true);
}