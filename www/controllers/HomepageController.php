<?php

class HomepageController extends BaseController {

  public function render($params) {
    $this->view->pageTitle = "Homepage";
    $this->view->isLoggedIn = isset($_SESSION["auth"]) && $_SESSION["auth"] == true;
    // ...
  }

}
