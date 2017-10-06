<?php

    function db_open()
    {

        global $db_conn, $avd_servername, $avd_dbname, $avd_password, $avd_username; // объявляем глобальные переменные

        $db_conn = new mysqli($avd_servername,$avd_username,$avd_password,$avd_dbname); // устанавлием соединение с базой

        if($db_conn->connect_errno) {   // если существует ошибка подключения, делаем исключение с сообщением ошибки

            throw new Exception(printf("Not connect:", $db_conn->connect_error));
        }

        $db_conn->set_charset('utf8');

    }


    function db_check_user_login($login_user) {  // проверка

        global $db_conn;

        $sql = "SELECT * FROM users WHERE users.login_user='$login_user'";
        $db_res = $db_conn->query($sql);

        if($db_res) {

            $result = $db_res->fetch_assoc(); // получаем строку логина.
            return $result;
        } else return [];

    }

    function db_get_tesk($result) { // получаем все новости в массив

        global $db_conn; // глобальная переменная для связи с БД.
        $sql = "SELECT * FROM pointer.tesk ORDER BY date_tesk DESC"; // sql скрипт для получение всех данных с таблица tesk.
        $db_res = $db_conn->query($sql); // отправляем запрос, после все полученные данные хранятся в перменной $db_res.

        if($db_res) { // если данные существуют.

            while ($db_row = $db_res->fetch_assoc()) { // fetch_assoc прыгает по строкам.

                $result[$db_row["id_tesk"]] = array ($db_row["title_tesk"],$db_row["content_tesk"],$db_row["date_tesk"],$db_row["status_tesk"]); //делаем многомерный массив в котором ключем будет id новости
                                                                                                                                                // в котором будет храниться  информация со всех строк
                                                                                                                                                // 0-Заголовок,1-Текст,2-Дата,3-Статус
            }
            return $result;
        }
    }

    function db_add_tesk($title,$content,$status) {
        global $db_conn; // глобальная переменная для связи с БД.
        $sql = "INSERT INTO pointer.tesk (title_tesk,content_tesk,status_tesk) 
                 VALUES('$title','$content','$status')"; // sql скрипт для отправки данных в БД.

        $db_res = $db_conn->query($sql); // выполняем sql.

        if($db_res) {
            return true; // если sql запрос прошел, то возращаем true;
        }


    }

    function db_del_tesk($id_tesk) {
        global $db_conn;
        $sql = "DELETE FROM pointer.tesk 
                  WHERE id_tesk = '$id_tesk'";

        $db_res = $db_conn->query($sql); // выполняем sql.

        if($db_res) {
            return true; // если sql запрос прошел, то возращаем true;
        }

    }




?>