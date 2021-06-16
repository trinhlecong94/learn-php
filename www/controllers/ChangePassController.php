<?php

class ChangePassController extends BaseController
{

  public function render($params)
  {
    $isLoggedIn = isset($_SESSION["auth"]) && $_SESSION["auth"] == true;

    if (isset($_POST["currentPass"]) && isset($_POST["newPass"]) && isset($_POST["againPass"])) {
      $currentPwd = $_POST["currentPass"];
      $newPwd = $_POST["newPass"];
      $againPwd = $_POST["againPass"];

      $user = User::getUserByNick($_SESSION["nick"]);
      $isCorrect = password_verify($currentPwd, $user["password"]);

      if (!$isCorrect)
        $this->redirect('/changePass?errorPwdIncorrect');
      if ($newPwd != $againPwd)
        $this->redirect('/changePass?errorMatch');
      
      $newPwdHash = password_hash($newPwd, PASSWORD_DEFAULT);
      User::updatePass($_SESSION["nick"], $newPwdHash);

      $this->redirect('/changePass?changeSuccess');
    }

    $this->view->pageTitle = "ChangePass";
    $this->view->isLoggedIn = $isLoggedIn;
    $this->view->isChangePassErrorCurrentPwd = isset($_GET["errorPwdIncorrect"]);
    $this->view->isChangePassErrorMatch = isset($_GET["errorMatch"]);
    $this->view->isChangeSuccess = isset($_GET["changeSuccess"]);
  }
}
