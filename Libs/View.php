<?php
namespace Libs;
/**
 * Class View
 * @package Libs
 */
class View {
    /**
     * @var string Path to templates directory
     */
    private $templatesPath = null;
    /**
     * @var string Name of current template
     */
    private $templateName = null;
    /**
     * @var string Default extensions for views files
     */
    private $templateExtension = '.phtml';

    /**
     * @var string Name of layout view file
     */
    private $layoutName = null;
    /**
     * @var bool View can be rendered without layout
     */
    private $layoutEnabled = true;

    /**
     * @var stdClass Internal storage for view variables
     */
    private $data = null;

    /**
     * @param null|string $templateName
     */
    public function __construct($templateName = null) {
        // set default templates path
        $this->setTemplatesPath('Views');

		// set default layout name
		$this->setLayoutName('layout');

        // define default view data as empty stdClass
		$this->data = new \stdClass();

		// view name could be defined later
        if ($templateName !== null) {
			$this->templateName = $templateName;
		}
    }

    /**
     * @param $path string
     */
    public function setTemplatesPath($path) {
        $this->templatesPath = APP_PATH . DIRECTORY_SEPARATOR . $path;
    }

    /**
     * @param $name string
     */
    public function setLayoutName($name) {
        $this->layoutName = $name;
    }

    public function enableLayout() {
        $this->layoutEnabled = true;
    }

    public function disableLayout() {
        $this->layoutEnabled = false;
    }

    /**
     * @param $key string
     * @param $value mixed
     */
    public function assign($key, $value) {
        $this->data->$key = $value;
    }

    /**
     * Capture output from the view
     *
     * @param null|string $fileName
     * @return bool|string
     */
    public function capture ($fileName = null) {
        if ($fileName === null) {
			$fileName = $this->templateName;
		}

		// found full view path
        $templatePath = $this->templatesPath . DIRECTORY_SEPARATOR . $fileName . $this->templateExtension;

		// if view wasn't found return false
        if (!file_exists($templatePath)) {
			return false;
		}

		// define variables from $this->data to current scope and render view with them
        extract(get_object_vars($this->data));
		ob_start();
		require $templatePath;

		return ob_get_clean();
	}

    /**
     * Render view with or without layout
     *
     * @return string
     */
    public function render() {
        $content = $this->capture();
		if ($this->layoutEnabled === false) {
			return $content;
		} else {
			$this->data->content = $content;

			return $this->capture($this->layoutName);
		}
    }
}