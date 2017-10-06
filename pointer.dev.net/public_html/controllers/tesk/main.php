<?php

if(!isset($_SESSION["auth"]) or  $_SESSION["auth"] = false) {
    header("Location: /error");
    exit;
}
$tpl_dictionary['title'] = "Список задач Alevada";


$tesk_array = db_get_tesk($tesk_array); // в массив $tesk_array вставляем все задачи, которые есть в БД.(устройства массива описано в db.php).
tpl_show_tesk($tesk_array); // Вызываем функцию tpl_show_tesk, задача которой все спарсенные шаблоны задач поместить в значение ключа $tpl_dictionary['all_tesk'] и в дальнейшем вывести его.
$out_tpl .= tpl_finish($tpl_massive['all_tesk']); // парсим








?>