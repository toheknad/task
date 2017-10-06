<?php


function debag_add($s)
{
    // функция сохранения в буфер отладочного сообщения
    global $debug_out, $site_is_debug;
    if (isset($site_is_debug) and ($site_is_debug)) {
        $debug_out = $debug_out . sprintf("<pre>%s</pre>", print_r($s, true));
    }
}