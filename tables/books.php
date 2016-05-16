<?php
namespace lib;
include "../db.php";
class Book extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `books` LEFT JOIN `publishers` ON books.publisher_id=publishers.publisher_id
LEFT JOIN `languages` ON languages.lang_id=books.lang_id
LEFT JOIN `authors` ON books.author_id=authors.author_id
LEFT JOIN `genres` ON books.genre_id=genres.id
ORDER BY books.book_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Book();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: index.php");
}
//var_dump($rows);die;
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-fixed-top" role="navigation">
            <ul id="panel" class="nav navbar-nav">
                <li><a href="output.php">Выдача книг</a></li>
                <li id="current"><a href="books.php">Книги</a></li>
                <li><a href="authors.php">Авторы</a></li>
                <li><a href="genres.php">Жанры</a></li>
                <li><a href="readers.php">Читатели</a></li>
                <li><a href="languages.php">Языки</a></li>
                <li><a href="publishers.php">Издательства</a></li>
                <li><a href="debtors.php">Должники</a></li>
                <li><a href="popular.php">Популярные книги месяца</a></li>
                <li><a href="">Добавить</a></li>
            </ul>
            <!--<button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>-->
            <div class="container">
                <table class="title table table-striped">
                    <tr>
                        <td width="50">№</td>
                        <td width="120">Назавние книги</td>
                        <td width="90">Год издания</td>
                        <td width="90">К-во страниц</td>
                        <td width="65">Цена</td>
                        <td width="120">Издат-во</td>
                        <td width="100">Язык</td>
                        <td width="130">Автор</td>
                        <td width="130">Жанр</td>
                        <td width="260"></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped" style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="50"><?= $rows[$i]['book_id']?></td>
                        <td width="120"><?= $rows[$i]['book_name']?></td>
                        <td width="90"><?= $rows[$i]['year']?></td>
                        <td width="90"><?= $rows[$i]['pages_num']?></td>
                        <td width="65"><?= $rows[$i]['price']?></td>
                        <td width="120"><?= $rows[$i]['publish_name']?></td>
                        <td width="100"><?= $rows[$i]['language']?></td>
                        <td width="130"><?= $rows[$i]['auth_name']?></td>
                        <td width="130"><?= $rows[$i]['genre']?></td>
                        <td><button type="button" class="btn btn-default">Изменить</button>
                            <button type="button" class="btn btn-default">Удалить</button></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</div>
</body>
</html>