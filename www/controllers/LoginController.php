<?php

class LoginController extends BaseController {

  public function render($params) {
    $isLoggedIn = isset($_SESSION["auth"]) && $_SESSION["auth"] == true;

    if($isLoggedIn)
      $this->redirect('/');

    if(isset($_POST["nick"]) && isset($_POST["password"])) {
      $nick = $_POST["nick"];
      $password = $_POST["password"];

      $user = User::getUserByNick($nick);
      if (empty($user))
        $this->redirect('/login?error');

      $isCorrect = password_verify($password, $user["password"]);

      if ($isCorrect) {
        $_SESSION["auth"] = true;
        $this->redirect('/');
      } else {
        $this->redirect('/login?error');
      }
    }

    $this->view->pageTitle = "Login";
    $this->view->isLoginError = isset($_GET["error"]);
    $this->view->isRegistered = isset($_GET["registered"]);
    $this->view->isLoggedIn = $isLoggedIn;
  }

}
