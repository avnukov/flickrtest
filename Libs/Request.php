<?php
namespace Libs;
/**
 * Class Request
 * @package Libs
 */
class Request {

    private $request = null;
    private $autoFilterGet = true;

    public function __construct() {
        $this->request = new \stdClass();

        $this->init();
    }

    /**
     * Init current request based on $_SERVER and $_GET superglobal variables
     */
    public function init() {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return null;
        }

        $parsedRequest = parse_url($_SERVER['REQUEST_URI']);
        $this->request->path = isset($parsedRequest['path']) ? $parsedRequest['path'] : '/';

        // determine should we filter $_GET automatically or not
        if ($this->autoFilterGet === true) {
            $this->request->get = $this->filter($_GET);
        } else {
            $this->request->get = $_GET;
        }

    }

    /**
     * Simple method for check what current request match to something
     *
     * @param $rule string
     * @return bool
     */
    public function check($rule) {
        if ($rule == $this->request->path) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get param from internal $_GET storage
     *
     * @param $name string
     * @return mixed
     */
    public function get($name) {
        if (isset($this->request->get[$name])) {
            return $this->request->get[$name];
        } else {
            return null;
        }
    }

    /**
     * Filter for input data
     *
     * @param $data array Data which need to be filtered
     * @return mixed
     */
    public function filter($data) {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->filter($value);
            } else {
                // simplest solution. could be updated later
                $data[$key] = strip_tags($value);
            }
        }

        return $data;
    }
}