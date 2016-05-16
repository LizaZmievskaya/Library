<?php
namespace lib;
include "db.php";
class Popular extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT COUNT(book_name) AS num, book_name, auth_name
FROM `output` LEFT JOIN `books` ON books.book_id=output.book_id
LEFT JOIN `authors` ON books.author_id=authors.author_id
WHERE MONTH(output_date)=MONTH(CURDATE()) GROUP BY book_name ORDER BY COUNT(book_name) DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Popular();
$rows = $out->fetchAll();

if (isset($_POST['menu'])){
    header("Location: index.php");
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/tables.css">
    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <form method="post">
        <nav id="header" class="navbar navbar-default navbar-fixed-top container" role="navigation">
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: right;">Главное меню</button>
            <table class="title table table-striped">
                <tr>
                    <td width="150">Была выдана раз</td>
                    <td width="500">Книга</td>
                    <td width="500">Автор</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="150"><?= $rows[$i]['num']?></td>
                        <td width="500"><?= $rows[$i]['book_name']?></td>
                        <td width="500"><?= $rows[$i]['auth_name']?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</div>
</body>
</html>