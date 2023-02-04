<?php
$dt = date("h:i:s");
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'];
$path = "$dt|$page|$ref\n";
$file = PATH_LOG;
$search = "$dt|$page|$ref";

if (!file_exists($file) || strpos(file_get_contents($file), $search) === false) {
    file_put_contents($file, $path, FILE_APPEND);
}