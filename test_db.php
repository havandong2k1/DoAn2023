<?php

$db_ = [
    'DSN'      => '',
    'hostname'  =>  'localhost',
    'username' => 'donghv_demo',
    'password' => 'ECggrhHuN44Wf3',
    'database' => 'donghv_demo',
    'DBDriver' => 'MySQLi',
    'DBPrefix' => '',
    'pConnect' => false,
    'charset'  => 'utf8',
    'DBCollat' => 'utf8_general_ci',
    'swapPre'  => '',
    'encrypt'  => false,
    'compress' => false,
    'strictOn' => false,
    'failover' => [],
    'port'     => 3306,
];

$conn = new mysqli($db_['hostname'],
    $db_['username'],
    $db_['password'],
    $db_['database']);
//Set timeout in seconds
$conn -> options(MYSQLI_OPT_CONNECT_TIMEOUT, 300);
if ($conn->connect_error) {
    echo "Failed: " . $conn->connect_error;
}
$query = "select * from students";
$result = $conn->query($query);
print_r("Kết quả query:\n");
print_r($result);

