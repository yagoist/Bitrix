<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("not_show_nav_chain", "Не показывать навигационное меню");
$APPLICATION->SetTitle("404 ошибка: Страница не найдена");
?>К сожалению, такая страница не найдена. <br>
 Данная страница была удалена с сайта, либо ее никогда не существовало. Вы можете вернуться на Главную страницу <a href="http://p1.yagodin_d_qschool.newgrade.vpool">На главную</a><br>
 Если Вы хотите что-то сообщить, напишите нам с помощью формы <a href="http://p1.yagodin_d_qschool.newgrade.vpool/example/contacts/">Обратная связь</a><br>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>