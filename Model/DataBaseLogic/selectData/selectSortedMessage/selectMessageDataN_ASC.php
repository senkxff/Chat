<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/DataBaseLogic/createConnection.php";
class SelectMessageDataN_ASC
{
    private $connection;

    public function __construct()
    {
        $this->connection = createConnection();
    }

    public function selectMessage(): array
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 25;
        $offset = ($page - 1) * $limit;

        if ($this->connection) {

            $query = "SELECT `sender_name`, `message`, `file`, `date`, `email` FROM `message_information` ORDER BY sender_name LIMIT ? OFFSET ?";
            $stmt = mysqli_prepare($this->connection, $query);

            if ($stmt === false) {
                die('Ошибка подготовки запроса: ' . mysqli_error($this->connection));
            }

            // Привязываем параметры
            mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);

            $executionResult = mysqli_stmt_execute($stmt);
            if ($executionResult === false) {
                die('Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt));
            }

            $result = mysqli_stmt_get_result($stmt);

            $messages = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $messages[] = $row;
            }

            return $messages;
        } else {
            die("Ошибка подключения базы данных!");
        }
    }
}