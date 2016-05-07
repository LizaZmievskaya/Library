<?php
namespace lib;
include "db.php";
class Book extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `books` LEFT JOIN `publishers` ON books.publisher_id=publishers.publisher_id
LEFT JOIN `languages` ON languages.lang_id=books.lang_id
LEFT JOIN `authors` ON books.author_id=authors.author_id
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
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/tables.css">
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <button id="add" type="button" class="btn btn-default">Добавить запись</button>
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: right;">Главное меню</button>
            <table class="title table table-striped">
                <tr>
                    <td width="50">№</td>
                    <td width="200">Назавние книги</td>
                    <td width="80">Год издания</td>
                    <td width="80">К-во страниц</td>
                    <td width="60">Цена</td>
                    <td width="150">Издательство</td>
                    <td width="130">Язык</td>
                    <td width="140">Автор</td>
                    <td width="260"></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped" style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="50"><?= $rows[$i]['book_id']?></td>
                        <td width="200"><?= $rows[$i]['book_name']?></td>
                        <td width="80"><?= $rows[$i]['year']?></td>
                        <td width="80"><?= $rows[$i]['pages_num']?></td>
                        <td width="60"><?= $rows[$i]['price']?></td>
                        <td width="150"><?= $rows[$i]['publish_name']?></td>
                        <td width="130"><?= $rows[$i]['language']?></td>
                        <td width="140"><?= $rows[$i]['auth_name']?></td>
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