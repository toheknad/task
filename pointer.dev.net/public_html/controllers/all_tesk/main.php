<?php
if(!isset($_SESSION["auth"]) or  $_SESSION["auth"] = false) {
    header("Location: /error");
    exit;
}



?>