<?php
session_start();

if (!isset($_SESSION['sortOrder'])) {
    $_SESSION['sortOrder'] = "T_ASC";
}

if (isset($_GET['selected_option'])) {
    $_SESSION['sortOrder'] = $_GET['selected_option'];
}

$sortOrder = $_SESSION['sortOrder'];

if ($sortOrder == "T_ASC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataT_ASC.php";
    $selectMessageData = new SelectMessageDataT_ASC();
} elseif ($sortOrder == "T_DESC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataT_DESC.php";
    $selectMessageData = new SelectMessageDataT_DESC();
} elseif ($sortOrder == "E_ASC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataE_ASC.php";
    $selectMessageData = new SelectMessageDataE_ASC();
} elseif ($sortOrder == "E_DESC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataE_DESC.php";
    $selectMessageData = new SelectMessageDataE_DESC();
} elseif ($sortOrder == "N_ASC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataN_ASC.php";
    $selectMessageData = new SelectMessageDataN_ASC();
} elseif ($sortOrder == "N_DESC") {
    require_once $_SERVER['DOCUMENT_ROOT'] . "\Model\DataBaseLogic\selectData\selectSortedMessage\selectMessageDataN_DESC.php";
    $selectMessageData = new SelectMessageDataN_DESC();
}

$messages = $selectMessageData->selectMessage();

foreach ($messages as $message) { ?>
    <tr>
        <?php
        echo "<td>" . htmlspecialchars($message["sender_name"] ?? "") . "</td>";
        echo "<td>" . htmlspecialchars($message["email"] ?? "") . "</td>";
        echo "<td>" . htmlspecialchars($message["message"] ?? "") . "</td>";

        if (!empty($message["file"])) {
            echo "<td><a href='/uploads/" . htmlspecialchars($message["file"]) . "'>открыть файл</a></td>";
        } else {
            echo "<td>-отсутствует-</td>";
        }

        echo "<td>" . htmlspecialchars($message["date"]) . "</td>";
        ?>
    </tr>
<?php }
