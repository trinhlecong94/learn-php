<?php

class LogoutController extends BaseController {

  public function render($params) {
    session_destroy();
    $this->redirect('/login');
  }

}
