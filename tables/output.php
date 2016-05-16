<?php
namespace lib;
include "db.php";
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
   /* public function getAuthorID($book_name){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT author_id FROM authors WHERE author_id=?");
        $stmt->execute([$book_name]);
        $result = $stmt->fetchAll();
        return $result;
    }
    public function getAuthorByID($author_id){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT auth_name FROM authors WHERE author_id=?");
        $stmt->execute([$author_id]);
        $result = $stmt->fetchAll();
        return $result;
    }*/
}
$out = new Out();
$rows = $out->fetchAll();
$books = $out->fetchBooks();
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
            <button id="add" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button>
            <button name="menu" type="submit" id="add" class="btn btn-default" style="float: right;">Главное меню</button>
            <table class="title table table-striped">
                <tr>
                    <td width="50">№</td>
                    <td width="120">Дата выдачи</td>
                    <td width="120">Дата возврата</td>
                    <td width="210">Название книги</td>
                    <td width="155">Автор</td>
                    <td width="230">Фамилия, имя читателя</td>
                    <td></td>
                </tr>
            </table>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped"  style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['output_id']?>" data-odate="<?= $rows[$i]['output_date']?>" data-rdate="<?= $rows[$i]['return_date']?>"
                        data-bname="<?= $rows[$i]['book_name']?>" data-aname="<?= $rows[$i]['auth_name']?>" data-sname="<?= $rows[$i]['second_name']?>"
                        data-fname="<?= $rows[$i]['first_name']?>">
                        <td width="50"><?= $rows[$i]['output_id']?></td>
                        <td width="120"><?= date('d.m.Y', strtotime($rows[$i]['output_date']))?></td>
                        <td width="120"><?= date('d.m.Y', strtotime($rows[$i]['return_date']))?></td>
                        <td width="210"><?= $rows[$i]['book_name']?></td>
                        <td width="155"><?= $rows[$i]['auth_name']?></td>
                        <td width="115"><?= $rows[$i]['second_name']?></td>
                        <td width="115"><?= $rows[$i]['first_name']?></td>
                        <td><button type="button" class="btn btn-default" data-toggle="modal" data-target="#editModal">Изменить</button>
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
                        <input name="odate" type="date" class="form-control" id="inputOdate">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата возврата</label>
                        <input name="rdate" type="date" class="form-control" id="inputRdate">
                    </div>
                    <div class="form-horizontal m">
                        <!--<input name="country" type="text" class="form-control" id="inputBook" placeholder="Название книги">-->
                        <select name="book" class="form-control">
                            <?php for ($i = 0; $i < count($books); $i++) {?>
                                <option><?= $books[$i]['book_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!--<div class="form-horizontal m">
                        <input name="country" type="text" class="form-control" id="inputAuthor" value="<?/*= $author=$out->getAuthorByID(); */?>" readonly>
                    </div>-->
                    <div class="form-horizontal m">
                        <input name="sname" type="text" class="form-control" id="inputSname" placeholder="Фамилия читателя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="fname" type="text" class="form-control" id="inputFname" placeholder="Имя читателя">
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
            <form method="post">
                <div class="modal-body">
                    <div class="form-horizontal date m">
                        <label>Дата выдачи</label>
                        <input name="odate" type="date" class="form-control" id="inputOdate">
                    </div>
                    <div class="form-horizontal date right m">
                        <label>Дата возврата</label>
                        <input name="rdate" type="date" class="form-control" id="inputRdate">
                    </div>
                    <div class="form-horizontal m">
                        <input name="country" type="text" class="form-control" id="inputBook" placeholder="Название книги">
                    </div>
                    <div class="form-horizontal m">
                        <input name="country" type="text" class="form-control" id="inputAuthor" placeholder="Автор">
                    </div>
                    <div class="form-horizontal m">
                        <input name="country" type="text" class="form-control" id="inputSname" placeholder="Фамилия читателя">
                    </div>
                    <div class="form-horizontal m">
                        <input name="country" type="text" class="form-control" id="inputFname" placeholder="Имя читателя">
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
<script src="../js/actions_output.js"></script>
</body>
</html>