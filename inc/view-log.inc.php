<?php

if (file_exists($file)) {
    $logs = file($file);
    foreach ($logs as $log) {
        list($dt, $page, $ref) = explode("|", $log);
        echo "$dt, $page -> $ref <br>";
    }
}