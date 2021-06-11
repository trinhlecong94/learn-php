<?php

class RegisterController extends BaseController {

  public function render($params) {
    $isLoggedIn = isset($_SESSION["auth"]) && $_SESSION["auth"] == true;

    if($isLoggedIn)
      $this->redirect('/');

    if(isset($_POST["nick"]) && isset($_POST["password"])) {
      $nick = $_POST["nick"];
      $password = $_POST["password"];

      $user = User::getUserByNick($nick);
      if (!empty($user))
        $this->redirect('/register?error');

      $passwordHash = password_hash($password, PASSWORD_DEFAULT);
      User::createUser($nick, $passwordHash);

      $this->redirect('/login?registered');
    }

    $this->view->pageTitle = "Register";
    $this->view->isRegistrationError = isset($_GET["error"]);
    $this->view->isLoggedIn = $isLoggedIn;
  }

}
