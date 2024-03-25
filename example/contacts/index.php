<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контактная информация");
?>
<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>

    Контактная информация<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>