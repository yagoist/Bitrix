<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>

    О компании<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>