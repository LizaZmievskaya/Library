<?php
$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$table = $_POST['table'];
$ident = $_POST['ident'];
$stmt = $db->prepare("DELETE FROM $table WHERE $ident = '$id'");
$stmt->execute();
/*$host  = $_SERVER['HTTP_HOST'];
header("Location: http://" . $host."/lib/tables/languages.php");*/
echo json_encode(['status'=>'success']);//NEVEDOMAYA HUJNYA