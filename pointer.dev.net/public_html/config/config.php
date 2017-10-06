<?php
// модуль config.php
// конфигурационный файл


//-------------------------------------------------------------------------------
// переменные для работы с БД
//-------------------------------------------------------------------------------
$avd_servername = "localhost"; // сервер БД
$avd_username = "root"; // пользователь БД
$avd_password = ""; // пароль пользователя БД
$avd_dbname = "pointer"; // Имя БД
// глобальный идентификатор подключения к БД
$db_conn = null;


$from_main_page = false; // переменная для проверки, что пользователь пришел из index.php.

$site_is_debug = true;
$debug_out = "";

$tpl_massive = array(); // массив для хранения tpl файлов.
$tpl_massive['all_tesk'] = ''; // для хранения задач

$out_tpl = ''; // для вывода tpl.

///Словарь для шаблонизатора.
$tpl_dictionary = array();
$tpl_dictionary['title'] = '';
$tpl_dictionary['content_tesk'] = '';
$tpl_dictionary['title_tesk'] = '';
$tpl_dictionary['status_tesk'] = '';
$tpl_dictionary['id_tesk'] = '';
$tpl_dictionary["all_tesk"] = ''; // Для хранения всех спарсенных задач и дальнейшего вывода их.
///////



$tesk_array = array(); // В этом массиве будут храниться задачи при парсинге.

$tesk_tpl = '';


?>