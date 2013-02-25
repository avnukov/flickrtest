<?php
namespace Libs\Flickr;

interface FlickrParserInterface {
    public function parse($string, $assoc = true);
}