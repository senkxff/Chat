<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DataBaseLogic/createConnection.php";
class SelectMessageDataE_DESC
{
    private $connection;

    public function __construct()
    {
        $this->connection = createConnection();
    }
    public function selectMessage(): mysqli_result
    {
        if ($this->connection) {
            $query = "SELECT `sender_name`, `message`, `file`, `date`, `email` FROM `message_information` ORDER BY email DESC";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_execute($stmt);
            return mysqli_stmt_get_result($stmt);
        } else {
            die ("Ошибка подключения базы данных!");
        }
    }
}