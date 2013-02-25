<?php
namespace Libs\Flickr;

interface AdapterInterface {
    public function parse($string, $assoc = true);
}