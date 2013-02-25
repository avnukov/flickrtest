<?php
namespace Libs\Flickr;

class AdapterJson implements AdapterInterface {
    public function parse($string, $assoc = true) {
        $string = str_replace('jsonFlickrApi(', '', $string);
        $string = substr($string, 0, - 1);

        return json_decode($string, $assoc);
    }
}