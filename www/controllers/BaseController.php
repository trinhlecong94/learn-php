<?php

abstract class BaseController {

  protected $viewName;

  protected $view;

  function __construct() {
    $this->view = new stdClass();
  }

  abstract public function render($params);

  protected function redirect($url) {
    header("Location: $url");
		header("Connection: close");
    exit;
  }

  protected final function showView() {
    extract((array)$this->view);
    require "views/" . $this->viewName . ".phtml";
  }

}
