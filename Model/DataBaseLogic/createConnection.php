<?php
function createConnection($localhost="localhost", $user="root", $password="5456527", $db_name="personal_information", $port="3305") : mysqli
{
    $connection = mysqli_connect($localhost, $user, $password, $db_name, $port);
    if (!$connection) {
        die("Соединение с базой данных не установлено!");
    } else {
        return $connection;
    }
}