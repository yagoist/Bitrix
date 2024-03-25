<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>
<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>
    Новости<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>