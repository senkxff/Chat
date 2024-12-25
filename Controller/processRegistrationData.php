<?php
require_once "../Model/DataBaseLogic/insertRegistrationData.php";
require_once "../Model/DataBaseLogic/selectPassword.php";
require_once "../Model/DataBaseLogic/selectName.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_account"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $userName = htmlspecialchars($_POST["user_name"]);
    $browser = $_SERVER["HTTP_USER_AGENT"];
    $ip = $_SERVER["REMOTE_ADDR"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $SetRegData = new InsertRegistrationData();
    $SetRegData->InsertData($email, $userName, $hashed_password, $browser, $ip);

    header("location: ../View/pages/chat.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["entrance_button"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $userName = htmlspecialchars($_POST["user_name"]);

    $GetPassword = new SelectPassword();
    $hashed_password = $GetPassword->selectPassword($email);

    $GetName = new SelectName();
    $name = $GetName->selectName($email);

    if (password_verify($password, $hashed_password) && $userName == $name) {
        header("Location: ../View/pages/chat.php");
    } else {
        header("../View/pages/chat.php");
        var_dump("вам необхожимо зарегистрироваться");
    }
}