<?php
 require_once $_SERVER["DOCUMENT_ROOT"] . "/Model/DataBaseLogic/selectData/selectCountOfMessage.php";

$countMessages = new SelectCountOfMessage();
$countMessages = $countMessages->selectCountMessage();

$countPages = ceil($countMessages / 25);

$currentPage = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$_SESSION["current_page"] = $currentPage;

if ($countPages == 0) {
    $countPages = 1;
}
?>

<div class="pagenavi_block">
    <a href="?page=<?= $currentPage - 1 > 0 ? $currentPage - 1 : 1; ?>">back</a>
    <?php for ($i = 1; $i <= $countPages; $i++) { ?>
        <a href="?page=<?= $i; ?>"><?= $i; ?></a>
    <?php } ?>
    <a href="?page=<?= $currentPage + 1 <= $countPages ? $currentPage + 1 : $countPages; ?>">next</a>
    <a href="?page=<?= $countPages; ?>">last</a>
</div>