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
    public function fetchPublishers(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT publisher_id, publish_name FROM publishers");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    public function fetchLang(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT lang_id, language FROM languages");
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
    public function fetchGenres(){
        $conn = $this->ConnectDB();
        $stmt = $conn->prepare("SELECT id, genre FROM genres");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}
$out = new Book();
$rows = $out->fetchAll();
$publish = $out->fetchPublishers();
$lang = $out->fetchLang();
$auth = $out->fetchAuth();
$genres = $out->fetchGenres();

/*if (isset($_POST['menu'])){
    header("Location: index.php");
}*/
//var_dump($rows);die;
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
                <li id="current"><a href="books.php">Книги</a></li>
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
                        <td width="120">Назавние книги</td>
                        <td width="90">Год издания</td>
                        <td width="90">К-во страниц</td>
                        <td width="65">Цена</td>
                        <td width="120">Издат-во</td>
                        <td width="100">Язык</td>
                        <td width="130">Автор</td>
                        <td width="130">Жанр</td>
                        <td width="260"><button id="add-btn" type="button" class="btn btn-default" data-toggle="modal" data-target="#addModal">Добавить запись</button></td>
                    </tr>
                </table>
            </div>
        </nav>
        <div class="table-responsive">
            <table class="table table-striped" style="text-align: center;">
                <?php for ($i = 0; $i < count($rows); $i++) {?>
                    <tr data-id="<?= $rows[$i]['book_id']?>" data-name="<?= $rows[$i]['book_name']?>"
                    data-year="<?= $rows[$i]['year']?>" data-pages="<?= $rows[$i]['pages_num']?>"
                    data-price="<?= $rows[$i]['price']?>" data-publish="<?= $rows[$i]['publish_name']?>"
                        data-lang="<?= $rows[$i]['language']?>" data-auth="<?= $rows[$i]['auth_name']?>"
                        data-genre="<?= $rows[$i]['genre']?>">
                        <td width="50"><?= $rows[$i]['book_id']?></td>
                        <td width="120"><?= $rows[$i]['book_name']?></td>
                        <td width="90"><?= $rows[$i]['year']?></td>
                        <td width="90"><?= $rows[$i]['pages_num']?></td>
                        <td width="65"><?= $rows[$i]['price']?></td>
                        <td width="120"><?= $rows[$i]['publish_name']?></td>
                        <td width="100"><?= $rows[$i]['language']?></td>
                        <td width="130"><?= $rows[$i]['auth_name']?></td>
                        <td width="130"><?= $rows[$i]['genre']?></td>
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
                        <input name="name" type="text" class="form-control" required id="inputName" placeholder="Название">
                    </div>
                    <div class="form-horizontal m">
                        <input name="year" type="number" min="1000" max="<?= date('Y'); ?>" class="form-control" required id="inputYear" placeholder="Год">
                    </div>
                    <div class="form-horizontal m">
                        <input name="pages" type="number" min="0" class="form-control" required id="inputPages" placeholder="Страницы">
                    </div>
                    <div class="form-horizontal m">
                        <input name="price" type="number" min="0" step="0.01" class="form-control" required id="inputPrice" placeholder="Цена">
                    </div>
                    <div class="form-horizontal m">
                        <label>Издательство</label>
                        <select name="publish" class="form-control">
                            <?php for ($i = 0; $i < count($publish); $i++) {?>
                                <option value="<?= $publish[$i]['publisher_id']?>"><?= $publish[$i]['publish_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Язык</label>
                        <select name="lang" class="form-control">
                            <?php for ($i = 0; $i < count($lang); $i++) {?>
                                <option value="<?= $lang[$i]['lang_id']?>"><?= $lang[$i]['language']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Автор</label>
                        <select name="auth" class="form-control">
                            <?php for ($i = 0; $i < count($auth); $i++) {?>
                                <option value="<?= $auth[$i]['author_id']?>"><?= $auth[$i]['auth_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Жанр</label>
                        <select name="genre" class="form-control">
                            <?php for ($i = 0; $i < count($genres); $i++) {?>
                                <option value="<?= $genres[$i]['id']?>"><?= $genres[$i]['genre']?></option>
                            <?php } ?>
                        </select>
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
            <form method="post" action="../update_book.php">
                <div class="modal-body">
                    <div class="form-horizontal m">
                        <input name="id" type="hidden" class="form-control" id="inputId"  placeholder="ID">
                    </div>
                    <div class="form-horizontal m">
                        <label>Название книги</label>
                        <input name="name" type="text" class="form-control" required id="inputName" placeholder="Название">
                    </div>
                    <div class="form-horizontal m">
                        <label>Год издания</label>
                        <input name="year" type="number" min="1000" max="<?= date('Y'); ?>" class="form-control" required id="inputYear" placeholder="Год">
                    </div>
                    <div class="form-horizontal m">
                        <label>Кол-во страниц</label>
                        <input name="pages" type="number" min="0" class="form-control" required id="inputPages" placeholder="Страницы">
                    </div>
                    <div class="form-horizontal m">
                        <label>Цена</label>
                        <input name="price" type="number" min="0" step="0.01" class="form-control" required id="inputPrice" placeholder="Цена">
                    </div>
                    <div class="form-horizontal m">
                        <label>Издательство</label>
                        <select name="publish" class="form-control">
                            <?php for ($i = 0; $i < count($publish); $i++) {?>
                                <option><?= $publish[$i]['publish_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Язык</label>
                        <select name="lang" class="form-control">
                            <?php for ($i = 0; $i < count($lang); $i++) {?>
                                <option><?= $lang[$i]['language']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Автор</label>
                        <select name="auth" class="form-control">
                            <?php for ($i = 0; $i < count($auth); $i++) {?>
                                <option><?= $auth[$i]['auth_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-horizontal m">
                        <label>Жанр</label>
                        <select name="genre" class="form-control">
                            <?php for ($i = 0; $i < count($genres); $i++) {?>
                                <option><?= $genres[$i]['genre']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <!--<input name="save" type="submit" class="btn btn-default" value="Сохранить"></td>-->
                    <button name="save" type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/actions_books.js"></script>
</body>
</html>