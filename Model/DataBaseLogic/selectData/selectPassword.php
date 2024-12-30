<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/Model/DataBaseLogic/createConnection.php";
class SelectPassword
{
    private $connection;
    public function __construct()
    {
        $this->connection = createConnection();
    }
    public function selectPassword($email) : string
    {
        if ($this->connection) {
            $query = "SELECT `hashed_password` FROM `users_information` WHERE `email` = ?";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $hashed_password = $row['hashed_password'];
                mysqli_close($this->connection);
            } else {
                mysqli_close($this->connection);
                die("Вам необходимо зарегистрироваться");
            }
            mysqli_stmt_close($stmt);
            return $hashed_password;
        } else {
            die ("Ошибка подключения к базе данных: запрос не выполнен!");
        }
    }
}