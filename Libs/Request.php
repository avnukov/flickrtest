<?php
namespace Libs;

class Request {

    private $request = null;

    public function __construct() {
        $this->request = new \stdClass();

        $this->init();

        return $this;
    }

    public function get($name) {
        if (isset($this->request->get[$name])) {
            return $this->request->get[$name];
        } else {
            return null;
        }
    }

    public function init() {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return null;
        }

        $parsedRequest = parse_url($_SERVER['REQUEST_URI']);

        $this->request->path = isset($parsedRequest['path']) ? $parsedRequest['path'] : '/';
        $this->request->get = $_GET;
        $this->request->post = $_POST;
    }

    public function check($rule) {
        if ($rule == $this->request->path) {
            return true;
        } else {
            return false;
        }
    }

    public function validate() {

    }

}