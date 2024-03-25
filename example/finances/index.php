<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Финансовая информация");
?>

<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>

    Финансовая информация<br>
<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>