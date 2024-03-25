<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ключевым клиентам");
?>

<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>

    Ключевым клиентам<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>