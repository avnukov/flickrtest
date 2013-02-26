<?php
namespace Libs;
/**
 * Simple Class for loading config file(s)
 *
 * Class Config
 * @package Libs
 */
class Config {
    private $instance = [];

    public function __construct() {
        // lets think what one file will be enough to hold all required params
        $this->instance = include_once(APP_PATH . DIRECTORY_SEPARATOR . 'Config.php');
    }

    /**
     * @param $key Name of config element
     * @return mixed
     */
    public function get($key) {
        if (isset($this->instance[$key])) {
            return $this->instance[$key];
        } else {
            return null;
        }
    }
}