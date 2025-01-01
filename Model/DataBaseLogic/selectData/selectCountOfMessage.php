<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DataBaseLogic/createConnection.php";

class SelectCountOfMessage
{
    private $connection;

    public function __construct()
    {
        $this->connection = createConnection();
    }

    public function selectCountMessage(): int
    {
        if ($this->connection) {
            $query = "SELECT COUNT(*) AS total FROM `message_information`";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $row = $result->fetch_assoc();
                return (int)$row['total'];
            }
            mysqli_close($this->connection);
        } else {
            die("Ошибка подключения базы данных!");
        }
    }
}
