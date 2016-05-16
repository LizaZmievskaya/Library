<?php
namespace lib;
include "db.php";
class Readers extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `readers` ORDER BY reader_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Readers();
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
            <button id="add" type="button" class="btn btn-default">Добавить запись</button>
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: right;">Главное меню</button>
            <table class="title table table-striped">
                <tr>
                    <td width="50">№</td>
                    <td width="140">Фамилия</td>
                    <td width="140">Имя</td>
                    <td width="250">Адрес</td>
                    <td width="130">Серия и № паспорта</td>
                    <td width="150">Телефон</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr>
                        <td width="50"><?= $rows[$i]['reader_id']?></td>
                        <td width="140"><?= $rows[$i]['second_name']?></td>
                        <td width="140"><?= $rows[$i]['first_name']?></td>
                        <td width="250"><?= $rows[$i]['adress']?></td>
                        <td width="130"><?= $rows[$i]['passport']?></td>
                        <td width="150"><?= $rows[$i]['phone_num']?></td>
                        <td><button type="button" class="btn btn-default">Изменить</button>
                            <button type="button" class="btn btn-default">Удалить</button></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</div>
<script src="../js/actions_readers.js"></script>
</body>
</html>