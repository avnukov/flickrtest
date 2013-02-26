<?php
namespace Libs;

class Front {
	private $actions = [];
    private $request = null;
    private $defaultActions = [];

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

    public function setNotFoundAction($callback) {
        $this->defaultActions['notFound'] = $callback;
    }

	public function run() {
        $actionFound = false;
        foreach ($this->actions as $route => $action) {
            if ($this->request->check($route)) {
                $actionFound = true;

                return $action();
            }
        }

        if ($actionFound === false) {
            $this->defaultActions['notFound']();
        }
	}
}
