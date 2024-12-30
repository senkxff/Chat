<?php require_once $_SERVER["DOCUMENT_ROOT"] . "/Model/DataBaseLogic/createConnection.php";
class InsertMessageData
{
    private $connection;
    public function __construct()
    {
        $this->connection = createConnection();
    }
    public function insertMessage($senderName, $message, $email, $filePath=null) : void
    {
        if ($this->connection) {
            $query = "INSERT INTO `message_information` (`sender_name`, `message`, `email`, `file`) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->connection, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $senderName, $message, $email, $filePath);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        } else {
            die("Ошибка подключения: нет подключения с базой данных!");
        }
    }
}