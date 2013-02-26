<?php
namespace Libs;

class Config {
    private $instance = [];

    public function __construct() {
        $this->instance = include_once(APP_PATH . DIRECTORY_SEPARATOR . 'Config.php');

        return $this;
    }

    public function get($key) {
        if (isset($this->instance[$key])) {
            return $this->instance[$key];
        } else {
            return null;
        }
    }
}