<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/Model/DataBaseLogic/createConnection.php";
class InsertRegistrationData
{
    private $connection;
    public function __construct()
    {
         $this->connection = createConnection();
    }
    public function insertData($email, $userName, $hashed_password, $browser, $ip) : void
    {
        if ($this->connection) {
            $query = "INSERT INTO `users_information` (`email`, `name`, `hashed_password`, `browser`, `ip`) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $email, $userName, $hashed_password, $browser, $ip);
            var_dump(mysqli_stmt_execute($stmt));
            mysqli_stmt_close($stmt);
        } else {
            die("Ошибка подключения к базе данных: запрос не выполнен!");
        }
    }
}