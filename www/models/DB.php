<?php

class DB {

  private static $connection;

  public static function connect($host, $user, $password, $database) {
    if (empty(self::$connection)) {
      self::$connection = new PDO("mysql:dbname=$database;host=$host", $user, $password);
    }
  }

  public static function fetch($sql, $data) {
    $sth = self::$connection->prepare($sql);
    $sth->execute($data);
    return $sth->fetchAll();
  }

  public static function execute($sql, $data) {
    $sth = self::$connection->prepare($sql);
    return $sth->execute($data);
  }

}
