<?php require_once "createConnection.php";
class SelectName
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
                $hashed_password = $row['name'];
                mysqli_close($this->connection);
            } else {
                $hashed_password = "";
                mysqli_close($this->connection);
            }
            mysqli_stmt_close($stmt);
            return $hashed_password;
        } else {
            die ("Ошибка подключения к базе данных: запрос не выполнен!");
        }
    }
}