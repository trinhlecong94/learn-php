<?php

class RouterController extends BaseController {

  private function transformPathToController($path) {
    $path = ltrim($path, "/");
    $path = trim($path);
    $path = explode("?", $path)[0];
    $path = explode("/", $path);

    $controllerUrl = $path[0];

    $controllerNameParts = explode("-", $controllerUrl);
    foreach($controllerNameParts as &$part)
      $part = ucfirst(strtolower($part));
    $controllerName = implode("", $controllerNameParts);

    return $controllerName;
  }

  public function render($params) {
    $path = $params[0];

    $controllerName = $this->transformPathToController($path);
    if (empty($controllerName))
      $controllerName = "Homepage";

    $controllerClassName = $controllerName . "Controller";

    if (file_exists("controllers/$controllerClassName.php")) {
			$controller = new $controllerClassName;
		} else {
      $controllerName = "NotFound";
			$controller = new NotFoundController;
    }

    $controller->viewName = $controllerName;
    $controller->render($params);

    $controller->showView();
  }

}
