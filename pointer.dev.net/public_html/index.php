<?php
    session_start();
    require_once("config/config.php");
    require_once("controllers/login/signup.php");
    require_once("lib/db.php");
    require_once("lib/util.php");
    require_once("lib/tpl.php");
    db_open();


    $request_uri = strtolower($_SERVER['REQUEST_URI']); // запрос после адреса сайта /index.html и т.д.

    $full_uri = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // полный адрес сайта

    $request_uri_array = preg_split("/(\/|-|_|\.)/", $request_uri, -1, PREG_SPLIT_NO_EMPTY); // разбиваем $request_uri на массив.


    if (preg_match("/([^a-zA-Z0-9\.\/\-\_])/", $request_uri)) {
        throw new Exception('Указанная страница - ' . $full_uri . ', не найдена!'); // делаем регулярку для проверки запроса, чтобы не прошли ненужные символы.
    }

    debag_add($request_uri);
    debag_add($request_uri_array);
    if(isset($request_uri_array[1])) {
        $cmd = "/tesk_".$request_uri_array[1];
    } else $cmd = '';


    switch ($request_uri) {

        case("/tesk"):
            tpl_load('controllers/tesk/tpl');
            include_once("controllers/tesk/main.php");
            break;

        case("/add_tesk"):
            tpl_load('controllers/add_tesk/tpl');
            include_once("controllers/add_tesk/main.php");
            break;

        case($cmd."_del"):
            db_del_tesk($request_uri_array[1]); // вызываем функцию для удаления задачи.
            header("Location: http://pointer.dev.net/tesk"); // в url помещаем ссылку на /tesk.
            exit;

        case($cmd."_all"):
            tpl_load('controllers/all_tesk/tpl');
            include_once("controllers/all_tesk/main.php");
            break;

        default:
            tpl_load('controllers/login/tpl');
            $tpl_dictionary['title'] = "Главная страница";
    }




    if (isset($_POST["btn_login"])) {     // после нажатия кнопки входа проверяем наличие юзера в базе.

        $user_login = strtolower($_POST["user_login"]); // получаем данные.
        $user_password = $_POST['user_password'];       //

        $user = db_check_user_login($user_login); // в переменную юзер помещаем строку с данными пользователя, если таковой есть.
        debag_add($user);

        if (isset($user["id_user"]) and ($user["password_user"] == $user_password)) { // делаем проерку по id и password'у.

            $_SESSION["auth"] = true;
            header("Location: http://pointer.dev.net/tesk"); // в url помещаем ссылку на /tesk.
            exit;
        }
    }

    if(isset($_POST["menu_add_tesk"])) {

        header("Location: http://pointer.dev.net/add_tesk"); // в url помещаем ссылку на /add_tesk.
        exit;
    }

    $out_tpl .=  tpl_finish($tpl_massive['head']);
    $out_tpl .=  tpl_finish($tpl_massive['body']);

    echo $out_tpl;


    if ($site_is_debug) {
        echo '<br>', 'Отладочная инфа', '<br>' . $debug_out;  // выводим отладочную информацию.
    }

    $db_conn->close();
?>
