<?php
session_start();

error_reporting(E_ALL); // Отображение всех типов ошибок
ini_set('display_errors', '1'); // Включение отображения ошибок
ini_set('display_startup_errors', '1'); // Включение ошибок, возникающих при запуске

require_once "../Model/DataBaseLogic/insertData/insertMessageData.php";
require_once "../Model/DataBaseLogic/selectData/selectUserName.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["send_button"])) {
    $email = $_SESSION["email"];

    $userName = new SelectUserName();
    $senderName = $userName->selectName($email);

    $message = htmlspecialchars($_POST["message"]);

    if ($_FILES["choose_button"]  && $_FILES["choose_button"]["error"] == UPLOAD_ERR_OK) {
        $filePath = "../uploads/";
        $fileTmpPath = $_FILES["choose_button"]["tmp_name"];
        $fileName = $_FILES["choose_button"]["name"];
        $fileSize = $_FILES["choose_button"]["size"];
        $fileType = $_FILES["choose_button"]["type"];

        if ($fileType == "image/jpg" || $fileType == "image/png" || $fileType == "image/gif") {
            $imageInfo = getimagesize($fileTmpPath);
            $imageWidth = $imageInfo[0];
            $imageHeight = $imageInfo[1];

            if ($imageWidth > 320 || $imageHeight > 240) {
                die("Ошибка: Изображение не должно превышать 320x240 пикселей.");
            } else {
                $filePath = basename($fileName);
                move_uploaded_file($fileTmpPath, $filePath);
            }

        } elseif ($fileType == "text/plain") {
            if ($fileSize > 100 * 1024) {
                die("Ошибка размера файла: текстовый файл слишком большой");
            } else {
                $filePath = "../Model/uploads/" . basename($fileName);
                move_uploaded_file($fileTmpPath, $filePath);
            }
        }

        $insertMessageData = new InsertMessageData();
        $insertMessageData->insertMessage($senderName, $message, $email, $filePath);
        header("Location: ../View/pages/chat.php?page=" . (isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 1));

    } else {
        $insertMessageData = new InsertMessageData();
        $insertMessageData->insertMessage($senderName, $message, $email);

        header("Location: ../View/pages/chat.php?page=" . (isset($_SESSION['current_page']) ? $_SESSION['current_page'] : 1));

    }

} else {
    die("Ошибка отправки сообщения: попробуйте перезайти на сайт!");
}