<?php
namespace lib;
include "../db.php";
class Out extends Db {
    public function fetchAll(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM `output` LEFT JOIN `books` ON output.book_id=books.book_id
LEFT JOIN `readers` ON output.reader_id=readers.reader_id
LEFT JOIN `authors` ON output.author_id=authors.author_id");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchBooks(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT book_name, book_id, author_id FROM books GROUP BY book_name");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchAuth(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT author_id, auth_name FROM authors");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchReader(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT * FROM readers");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Out();
$rows = $out->fetchAll();
$books = $out->fetchBooks();
$auth = $out->fetchAuth();
$reader = $out->fetchReader();
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
                <li id="current"><a href="output.php">Выдача книг</a></li>
                <li><a href="books.php">Книги</a></li>
                <li><a href="authors.php">Авторы</a></li>
                <li><a href="genres.php">Жанры</a></li>
                <li><a href="readers.php">Читатели</a></li>
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
                        <td width="120">Дата выдачи</td>
                        <td width="120">Дата возврата</td>
                        <td width="210">Название книги</td>
                        <td width="155">Автор</td>
                        <td width="230">Фамилия, имя читателя</td>
                        <td><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['output_id']?>" data-odate="<?= $rows[$i]['output_date']?>" data-rdate="<?= $rows[$i]['return_date']?>"
                        data-bname="<?= $rows[$i]['book_name']?>" data-aname="<?= $rows[$i]['auth_name']?>" data-sname="<?= $rows[$i]['second_name']?>"
                        data-fname="<?= $rows[$i]['first_name']?>">
                        <td width="50"><?php echo $rows[$i]['output_id']?></td>
                        <td width="120"><?= date('d.m.Y', strtotime($rows[$i]['output_date']))?></td>
                        <td width="120"><?php if($rows[$i]['return_date']==0){
                                echo "---";
                            } else{ echo date('d.m.Y', strtotime($rows[$i]['return_date']));} ?></td>
                        <td width="210"><?= $rows[$i]['book_name']?></td>
                        <td width="155"><?= $rows[$i]['auth_name']?></td>
                        <td width="115"><?= $rows[$i]['second_name']?></td>
                        <td width="115"><?= $rows[$i]['first_name']?></td>
                        <td><button type="button" name="edit" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
                            <input name="delete" type="submit" class="btn btn-default" value="Удалить"></td>
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
                    <div class="form-horizontal date m">
                        <label>Дата выдачи</label>
                        <input name="odate" type="date" class="form-control" id="inputOdate" max="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата возврата</label>
                        <input name="rdate" type="date" class="form-control" id="inputRdate" max="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal m">
                        <select name="book" class="form-control">
                            <?php for ($i = 0; $i < count($books); $i++) {?>
                                <option value="<?= $books[$i]['book_id']?>"><?= $books[$i]['book_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Фамилия, имя читателя</label>
                        <select name="reader" class="form-control">
                            <?php for ($i = 0; $i < count($reader); $i++) {?>
                                <option value="<?= $reader[$i]['reader_id']?>"><?= $reader[$i]['second_name']?> <?= $reader[$i]['first_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!--<div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" id="inputSname" placeholder="Фамилия читателя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" id="inputFname" placeholder="Имя читателя">
                    </div>-->
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
            <form method="post" action="../update_out.php">
                <div class="modal-body">
                    <div class="form-horizontal date m">
                        <label>Дата выдачи</label>
                        <input name="odate" type="date" class="form-control" id="inputOdate" max="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата возврата</label>
                        <input name="rdate" type="date" class="form-control" id="inputRdate" max="<?= date('Y-m-d')?>">
                    </div>
                    <div class="form-horizontal m">
                        <select name="book" class="form-control">
                            <?php for ($i = 0; $i < count($books); $i++) {?>
                                <option value="<?= $books[$i]['book_id']?>"><?= $books[$i]['book_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Фамилия, имя читателя</label>
                        <select name="reader" class="form-control">
                            <?php for ($i = 0; $i < count($reader); $i++) {?>
                                <option value="<?= $reader[$i]['reader_id']?>"><?= $reader[$i]['second_name']?> <?= $reader[$i]['first_name']?></option>
                            <?php } ?>
                        </select>
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
<script src="../js/actions_output.js"></script>
</body>
</html>