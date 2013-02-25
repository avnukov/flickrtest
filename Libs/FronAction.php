<?php
namespace Libs;

class FrontAction {
	private $rule = null;
	private $callback = null;

	public function __construct($rule, $callback) {
		$this->rule = $rule;
		$this->callback = $callback;
	}

	public function checkRule($params) {

	}

	public function run($data) {
		return $this->callback($data);
	}

}