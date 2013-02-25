<?php
namespace Libs\Flickr;

class FlickrParserJson implements FlickrParserInterface {
    public function parse($string, $assoc = true) {
        $string = str_replace('jsonFlickrApi(', '', $string);
        $string = substr($string, 0, - 1);

        return json_decode($string, $assoc);
    }
}