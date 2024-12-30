<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/Model/DataBaseLogic/createConnection.php";
class SelectUserName
{
    private $connection;
    public function __construct()
    {
        $this->connection = createConnection();
    }
    public function selectName($email) : string
    {
        if ($this->connection) {
            $query = "SELECT `name` FROM `users_information` WHERE `email` = ?";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $userName = $row['name']; $_SESSION["user_name"] = $userName;
                mysqli_close($this->connection);
            } else {
                $userName = "Вы не вошли в аккаунт!";
                mysqli_close($this->connection);
            }
            mysqli_stmt_close($stmt);
            return $userName;
        } else {
            die ("Ошибка подключения к базе данных: запрос не выполнен!");
        }
    }
}