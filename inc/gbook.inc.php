<?php
/* Основные настройки */
define("DB_HOST", "localhost:3306");
define("DB_LOGIN", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "gbook");

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if ( !$link ) {
    echo "ERROR:"
    . mysqli_connect_error();
    die;
}
/* Основные настройки */

/* Сохранение записи в БД */
if ( isset($_POST['name']) ) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $msg = $_POST["msg"];

    $sql = "INSERT INTO msgs(name, email, msg) VALUES(?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $msg);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: index.php?id=gbook");
}
/* Сохранение записи в БД */

/* Удаление записи из БД */
if ( isset($_POST['id']) ) {
    $id = $_POST['id'];
    $sql = "DELETE FROM msgs WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: index.php?id=gbook");
}
/* Удаление записи из БД */
?>
<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="name" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>
<table class="table">
    <tr>
        <th>Name</th>
        <th>email</th>
        <th>Message</th>
    </tr>
<?php
/* Вывод записей из БД */
if ($link) {
    $result = mysqli_query($link, "SELECT * FROM msgs");
    while ($data = mysqli_fetch_assoc($result)) {
        echo "<tr>" .
        "<td>" . $data["name"] . "</td>" .
        "<td>" . $data["email"] . "</td>" .
        "<td>" . $data["msg"] . "</td>" .
        "<td>" .
        "<form action='' method='post'>" .
        "<input type='hidden' name='id' value='" . $data["id"] . "'>" .
        "<button type='submit' class='delete-btn'> <i class='fas fa-times'></i> </button>" .
        "</form>" .
        "</td>" . 
        "</tr>";
    }
}

/* Вывод записей из БД */
?>
</table>


<?php mysqli_close($link); ?>