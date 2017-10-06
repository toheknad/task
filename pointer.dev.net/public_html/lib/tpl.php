<?php


function tpl_load($directory)
{

    global $tpl_massive; // массив, в котором буду tpl файлы.

    if (!file_exists($directory)) {  // проверяем существование директории.
        return;
    }
    $files_of_directory = scandir($directory); // получаем файлы в директории, которая указывается в параметрах при вызове метода.

    foreach ($files_of_directory as $tpl) { // записываем каждый файл директории в переменную $tpl

        $tpl = $directory . "/" . $tpl; // делаем полный путь к файлу.

        if (is_file($tpl)) { // проверка, чтобы проходили только файлы

            $info_file = pathinfo($tpl); // узнаем информацию о файле: расширение, имя файла и т.д.

            if ($info_file['extension'] === 'tpl') { // если файл имеет расширение tpl, то добавляем его в массив как значение в $tpl_massive, а ключем будет имя файла.

                $tpl_massive[$info_file['filename']] = file_get_contents($tpl);
            }
        }
    }

}

function tpl_finish($template) // меняем значение ключевых слов указаных в $tpl_dictionary на значение указанные в этом массиве.
{
    global $tpl_dictionary;

        foreach ($tpl_dictionary as $f => $v) { // $f - content, title, title_tesk то есть ключ, а $v - значение на которое мы будем заменять в шаблонах.
            $template = str_replace('{' . $f . '}', $v, $template); // ищем и заменяем.
        }


    return $template; // возвращаем измененный шаблон.
}

function tpl_show_tesk($tesk_array) { // в параментре указывается многомерный массив с данными

    global $tpl_dictionary, $tpl_massive, $out_tpl, $tesk_tpl; // $tesk_tpl - переменная в которой буду храниться все спрасенные задачи.

    foreach ($tesk_array as $id => $values) { // выбираем данные из базы данных

        $tpl_dictionary['title_tesk'] = $values[0]; // Заполняем в нашем словаре значение ключей, чтобы в конце каждого цикла вставлять их в задачу.
        $tpl_dictionary['content_tesk'] = $values[1]; // тоже самое.
        $tpl_dictionary['status_tesk'] = $values[3];
        $tpl_dictionary['id_tesk'] = $id; // Для подстановки id задачи, чтобы в дальнейшем была возможность удаления, редактирования и полного прочтения задачи.
        switch ($tpl_dictionary['status_tesk']) {
            case(1):
                $tesk_tpl .= tpl_finish($tpl_massive['short_tesk_green']);
                break;
            case(2):
                $tesk_tpl .= tpl_finish($tpl_massive['short_tesk_yellow']);
                break;
            case(3):
                $tesk_tpl .= tpl_finish($tpl_massive['short_tesk_red']);
                break;
        }
    } return $tpl_dictionary["all_tesk"] = $tesk_tpl; // вставляем все задачи в ключ нашего словаря, которые в конце index.php буду выведены на сайт.

}

?>