<?php

class User {

  public static function getUserByNick($nick) {
    $users = DB::fetch(
      "SELECT * from users WHERE nick = :nick LIMIT 0,1",
      ["nick" => $nick]
    );
    if (empty($users)) return [];
    return $users[0];
  }

  public static function createUser($nick, $password) {
    return DB::execute(
      "INSERT INTO `users`(`nick`, `password`) VALUES (:nick, :password)",
      [
        "nick" => $nick,
        "password" => $password
      ]
    );
  }

}
