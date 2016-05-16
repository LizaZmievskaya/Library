<?php
namespace lib;
include "../db.php";
class Authors extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `authors` LEFT JOIN `countries`
ON authors.country_id=countries.country_id
ORDER BY author_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Authors();
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
                <li><a href="books.php">Книги</a></li>
                <li id="current"><a href="authors.php">Авторы</a></li>
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
                        <td width="250">Автор</td>
                        <td width="150">Страна</td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="50"><?= $rows[$i]['author_id']?></td>
                        <td width="250"><?= $rows[$i]['auth_name']?></td>
                        <td width="150"><?= $rows[$i]['country']?></td>
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