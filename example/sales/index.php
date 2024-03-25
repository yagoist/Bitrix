<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отдел продаж");
?>


<?php print_r($APPLICATION->GetDirProperty('description')); ?> <br>
<?php print_r($APPLICATION->GetDirProperty('keywords')); ?> <br>
    Отдел продаж<br>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>