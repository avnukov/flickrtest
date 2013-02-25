<?php
namespace Libs;

class Front {
	private $actions = [];
    private $request = null;
    private $defaultAction = null;

	public function __construct() {
        return $this;
	}

    public function setRequest(Request $request) {
        $this->request = $request;

        return $this;
    }

    public function getRequest() {
        return $this->request;
    }

	public function addAction($route, $callback) {
		$this->actions[$route] = $callback;
	}

	public function run() {
        foreach ($this->actions as $route => $action) {
            if ($this->request->check($route)) {
                return $action();
            }
        }
	}
}
