<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Для клиентов");
?>

<?php print_r($APPLICATION->GetDirProperty('description'));?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords'));?> <br>

    Для клиентов<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>