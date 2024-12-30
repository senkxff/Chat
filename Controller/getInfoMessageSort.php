<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["selected_option"])) {

    $_SESSION["sortOrder"] = $_GET["selected_option"];
}
