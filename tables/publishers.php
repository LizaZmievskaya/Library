<?php
namespace lib;
include "../db.php";
class Publishers extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `publishers` ORDER BY publisher_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Publishers();
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
                <li><a href="readers.php">Читатели</a></li>
                <li><a href="languages.php">Языки</a></li>
                <li id="current"><a href="publishers.php">Издательства</a></li><br>
                <li><a href="debtors.php">Должники</a></li>
                <li><a href="popular.php">Популярные книги месяца</a></li>
            </ul>
            <!--<button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>-->
            <div class="container">
                <table class="title table table-striped">
                    <tr>
                        <td width="50">№</td>
                        <td width="120">Название</td>
                        <td width="100">Город</td>
                        <td width="150">Телефон</td>
                        <td width="220">E-mail</td>
                        <td>Веб-сайт</td>
                        <td width="260"><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['publisher_id']?>" data-name="<?= $rows[$i]['publish_name']?>"
                        data-city="<?= $rows[$i]['city']?>" data-phone="<?= $rows[$i]['phone_num']?>"
                        data-email="<?= $rows[$i]['e_mail']?>" data-site="<?= $rows[$i]['web_site']?>">
                        <td width="50"><?= $rows[$i]['publisher_id']?></td>
                        <td width="120"><?= $rows[$i]['publish_name']?></td>
                        <td width="100"><?= $rows[$i]['city']?></td>
                        <td width="150"><?= $rows[$i]['phone_num']?></td>
                        <td width="220"><?= $rows[$i]['e_mail']?></td>
                        <td><?= $rows[$i]['web_site']?></td>
                        <td width="260"><button name="edit" type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
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
                        <input name="name" type="text" class="form-control" required id="inputName" placeholder="Название">
                    </div>
                    <div class="form-horizontal m">
                        <input name="city" type="text" class="form-control" required id="inputCity" placeholder="Город">
                    </div>
                    <div class="form-horizontal m">
                        <input name="phone" type="tel" pattern="\d\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}"
                               required class="form-control" id="inputPhone" placeholder="Телефон в формате x(xxx)-xxx-xx-xx">
                    </div>
                    <div class="form-horizontal m">
                        <input name="email" type="email" class="form-control"
                               required id="inputEmail" placeholder="E-mail">
                    </div>
                    <div class="form-horizontal m">
                        <input name="site" type="url" class="form-control"
                               required id="inputSite" placeholder="Веб-сайт издательства">
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
                        <input name="name" type="text" class="form-control" required id="inputName" placeholder="Название">
                    </div>
                    <div class="form-horizontal m">
                        <input name="city" type="text" class="form-control" required id="inputCity" placeholder="Город">
                    </div>
                    <div class="form-horizontal m">
                        <input name="phone" type="tel" pattern="\d\([0-9]{3}\)\-[0-9]{3}\-[0-9]{2}\-[0-9]{2}"
                               required class="form-control" id="inputPhone" placeholder="Телефон в формате x(xxx)-xxx-xx-xx">
                    </div>
                    <div class="form-horizontal m">
                        <input name="email" type="email" class="form-control"
                               required id="inputEmail" placeholder="E-mail">
                    </div>
                    <div class="form-horizontal m">
                        <input name="site" type="url" class="form-control"
                               required id="inputSite" placeholder="Веб-сайт издательства">
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
<script src="../js/actions_publishers.js"></script>
</body>
</html>