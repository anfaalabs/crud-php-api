<?php

$connection = new mysqli(
  $db_connection->SERVER, // Database server
  $db_connection->USER, // Database username
  $db_connection->PASSWORD, // Database password
  $db_connection->DB_NAME // Database name
);

if ($connection->connect_errno) {
  die("DATABASE ERROR: " . $connection->connect_error);
}
