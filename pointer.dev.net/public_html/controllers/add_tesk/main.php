<?php
if(!isset($_SESSION["auth"]) or  $_SESSION["auth"] = false) {
    header("Location: /error");
    exit;
}
$tpl_dictionary['title'] = "Добавление задач Alevada";

if(isset($_POST['tesk_status_add']) & isset($_POST['tesk_text_add']) & isset($_POST['tesk_titel_add'])) { // проверяем наличие переданных данных, после нажатия на кнопку отправить.

    $tesk_text = $_POST['tesk_text_add']; // инициализируем переменные с получеными данными.
    $tesk_status = $_POST['tesk_status_add'];//
    $tesk_title = $_POST['tesk_titel_add'];//

    if(db_add_tesk($tesk_title,$tesk_text,$tesk_status)) { // если все прошло успешно, то отправляем пользователя на главную страницу.
        header("Location: /tesk");
    }

}

?>