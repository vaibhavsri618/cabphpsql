<?php

class Dbconnect
{

public $username;
public $userpass;
public $server;
public $db;
public $conn;

function __construct()
{
$this->conn = new mysqli("localhost", "root", "", "cab");

// Check connection
if ($this->conn->connect_error) {
    die("Connection failed: " . $this->conn->connect_error);
}
}
}

?>

