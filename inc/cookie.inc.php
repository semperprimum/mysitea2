<?php
date_default_timezone_set('Asia/Almaty');
$visited = 0;
if (isset($_COOKIE['pageVisited'])) {
    $visited = $_COOKIE['pageVisited'];
};
if ($_COOKIE["lastVisited"] != date("d-m-Y")) {
    $visited++;
}
$lastVisited = date('d-m-Y');
if (isset($_COOKIE['lastVisited'])) {
    $lastVisited = $_COOKIE['lastVisited'];
};
setcookie("pageVisited", $visited, time()+86400);
setcookie("lastVisited", $lastVisited, time()+86400);
?>