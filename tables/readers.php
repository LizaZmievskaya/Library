<?php
namespace lib;
include "../db.php";
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

/*if (isset($_POST['menu'])){
    header("Location: index.php");
}*/
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
        <nav id="header" class="navbar navbar-fixed-top" role="navigation">
            <ul id="panel" class="nav navbar-nav">
                <li><a href="output.php">Выдача книг</a></li>
                <li><a href="books.php">Книги</a></li>
                <li><a href="authors.php">Авторы</a></li>
                <li><a href="genres.php">Жанры</a></li>
                <li id="current"><a href="readers.php">Читатели</a></li>
                <li><a href="languages.php">Языки</a></li>
                <li><a href="publishers.php">Издательства</a></li><br>
                <li><a href="debtors.php">Должники</a></li>
                <li><a href="popular.php">Популярные книги месяца</a></li>
            </ul>
            <!--<button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>-->
            <div class="container">
                <table class="title table table-striped">
                    <tr>
                        <td width="50">№</td>
                        <td width="140">Фамилия</td>
                        <td width="140">Имя</td>
                        <td width="250">Адрес</td>
                        <td width="130">Серия и № паспорта</td>
                        <td width="150">Телефон</td>
                        <td><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr  data-id="<?= $rows[$i]['reader_id']?>" data-sname="<?= $rows[$i]['second_name']?>"
                         data-fname="<?= $rows[$i]['first_name']?>" data-adress="<?= $rows[$i]['adress']?>"
                         data-passport="<?= $rows[$i]['passport']?>" data-phone="<?= $rows[$i]['phone_num']?>">
                        <td width="50"><?= $rows[$i]['reader_id']?></td>
                        <td width="140"><?= $rows[$i]['second_name']?></td>
                        <td width="140"><?= $rows[$i]['first_name']?></td>
                        <td width="250"><?= $rows[$i]['adress']?></td>
                        <td width="130"><?= $rows[$i]['passport']?></td>
                        <td width="150"><?= $rows[$i]['phone_num']?></td>
                        <td><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                            <input name="delete" type="button" class="btn btn-default" value="Удалить"></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </form>
</div>
<!--ADD MODAL-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Добавление новой записи</h4>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" required id="inputSname" placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" required id="inputFname" placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="adress" type="text" class="form-control" required id="inputAdress" placeholder="Адрес">
                    </div>
                    <div class="form-horizontal m">
                        <input name="passport" type="tel" pattern="[А-Я]{2}\s[0-9]{3}\s[0-9]{3}" class="form-control"
                               required id="inputPassport" placeholder="Серия и № паспорта в формате АА 777 777">
                    </div>
                    <div class="form-horizontal m">
                        <input name="phone" type="tel" pattern="\d\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}"
                               required class="form-control" id="inputPhone" placeholder="Телефон в формате x(xxx)-xxx-xx-xx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="add" type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--EDIT MODAL-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Редактирование записи</h4>
            </div>
            <form method="post" action="../update_reader.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" id="inputSname" required placeholder="Фамилия">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" id="inputFname" required placeholder="Имя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="adress" type="text" class="form-control" id="inputAdress" required placeholder="Адрес">
                    </div>
                    <div class="form-horizontal m">
                        <input name="passport" type="tel" pattern="[А-Я]{2}\s[0-9]{3}\s[0-9]{3}" class="form-control"
                               required id="inputPassport" placeholder="Серия и № паспорта в формате АА 777 777">
                    </div>
                    <div class="form-horizontal m">
                        <input name="phone" type="tel" pattern="\d\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}"
                               required class="form-control" id="inputPhone" placeholder="Телефон в формате x(xxx)-xxx-xx-xx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button name="save" type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/actions_readers.js"></script>
</body>
</html>