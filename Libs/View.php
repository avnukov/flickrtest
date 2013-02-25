<?php
namespace Libs;

class View {
    private $templatesPath = null;
    private $templateName = null;

    private $templateExtension = '.phtml';

    private $layoutFile = null;
    private $layoutEnabled = true;

    private $data = null;

    public function __construct($templateName = null) {
        // set default templates path
        $this->setTemplatesPath('Views');

		// set default layout name
		$this->setLayoutName('layout');

		$this->data = new \stdClass();


		if ($templateName !== null) {
			$this->templateName = $templateName;
		}

		return $this;
    }

    public function setTemplatesPath($path) {
        $this->templatesPath = APP_PATH . DIRECTORY_SEPARATOR . $path;

		return $this;
    }

    public function setLayoutName($name) {
        $this->layoutName = $name;

		return $this;
    }

    public function enableLayout() {
        $this->layoutEnabled = true;

		return $this;
    }

    public function disableLayout() {
        $this->layoutEnabled = false;

		return $this;
    }

    public function assign($key, $value) {
        $this->data->$key = $value;

		return $this;
    }

    public function capture ($fileName = null) {
		if ($fileName === null) {
			$fileName = $this->templateName;
		}

		$templatePath = $this->templatesPath . DIRECTORY_SEPARATOR . $fileName . $this->templateExtension;

		if (!file_exists($templatePath)) {
			return false;
		}

		extract(get_object_vars($this->data));
		ob_start();
		require $templatePath;

		return ob_get_clean();
	}

	public function render($layoutEnabled = true) {
        $content = $this->capture();
		if ($layoutEnabled === false) {
			return $layoutEnabled;
		} else {
			$this->data->content = $content;

			return $this->capture($this->layoutName);
		}
    }
}