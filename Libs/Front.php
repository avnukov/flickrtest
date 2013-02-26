<?php
namespace Libs;
/**
 * Front Controller for processing incoming requests
 *
 * Class Front
 * @package Libs
 */
class Front {
    /**
     * @var array list of actions which could be procesed
     */
    private $actions = [];
    /**
     * @var Request
     */
    private $request = null;
    /**
     * Default action. For now hold only notFound action (404). Could be added Access Denied,
     * Maintenance or something other
     *
     * @var array
     */
    private $defaultActions = [];

	public function __construct() {}

    /**
     * Set current server request to front controller
     *
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }

    /**
     * Get current front controller request
     *
     * @return Request|null
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * Add new action to the actions list
     *
     * @param $route string Route path, like "/page"
     * @param $callback Callable function which will be executed for this route
     */
    public function addAction($route, $callback) {
		$this->actions[$route] = $callback;
	}

    /**
     * Set default action for "Not Found" error (404)
     *
     * @param $callback
     */
    public function setNotFoundAction($callback) {
        $this->defaultActions['notFound'] = $callback;
    }

    /**
     * Execute Front controller
     *
     * @return mixed
     */
    public function run() {
        $actionFound = false;

        // trying to match current request with one of registered actions
        foreach ($this->actions as $route => $action) {
            if ($this->request->check($route)) {
                $actionFound = true;
                // run & return callback result for matched action
                return $action();
            }
        }

        // if no one action was matched execute "Not Found" action
        if ($actionFound === false) {
            return $this->defaultActions['notFound']();
        }
	}
}
