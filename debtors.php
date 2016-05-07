<?php
namespace lib;
include "db.php";
class Debtors extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT output_date, second_name, first_name, book_name, auth_name
FROM `output` LEFT JOIN `books` ON output.book_id=books.book_id
LEFT JOIN `readers` ON output.reader_id=readers.reader_id
LEFT JOIN `authors` ON output.author_id=authors.author_id WHERE return_date=0 ORDER BY output_date");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Debtors();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: index.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/tables.css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: right;">Главное меню</button>
            <table class="title table table-striped">
                <tr>
                    <td width="150">Дата выдачи</td>
                    <td width="400">Фамилия, имя читателя</td>
                    <td width="300">Книга</td>
                    <td width="300">Автор</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="150"><?= date('d.m.Y', strtotime($rows[$i]['output_date']))?></td>
                        <td width="200"><?= $rows[$i]['second_name']?></td>
                        <td width="200"><?= $rows[$i]['first_name']?></td>
                        <td width="300"><?= $rows[$i]['book_name']?></td>
                        <td width="300"><?= $rows[$i]['auth_name']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</div>
</body>
</html>