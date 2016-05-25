<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$name = $_POST['name'];
$year = $_POST['year'];
$pages = $_POST['pages'];
$price = $_POST['price'];
$publish = $_POST['publish'];
$lang = $_POST['lang'];
$auth = $_POST['auth'];
$genre = $_POST['genre'];
$id = $_POST['id'];
//ID издательства
$stmt1 = $db->prepare("SELECT publisher_id FROM publishers WHERE publish_name='$publish'");
$stmt1->execute();
$id1 = $stmt1->fetchAll();
$publish_id = $id1[0]['publisher_id'];
//ID языка
$stmt2 = $db->prepare("SELECT lang_id FROM languages WHERE language='$lang'");
$stmt2->execute();
$id2 = $stmt2->fetchAll();
$lang_id = $id2[0]['lang_id'];
//ID автора
$stmt3 = $db->prepare("SELECT author_id FROM authors WHERE auth_name='$auth'");
$stmt3->execute();
$id3 = $stmt3->fetchAll();
$auth_id = $id3[0]['author_id'];
//ID жанра
$stmt4 = $db->prepare("SELECT id FROM genres WHERE genre='$genre'");
$stmt4->execute();
$id4 = $stmt4->fetchAll();
$genre_id = $id4[0]['id'];
$stmt = $db->prepare("UPDATE books SET book_name = '$name', year = '$year',
pages_num = '$pages', price = '$price', publisher_id = '$publish_id',
lang_id = '$lang_id', author_id = '$auth_id', genre_id = '$genre_id' WHERE book_id = '$id'");
$stmt->execute();
$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/books.php");