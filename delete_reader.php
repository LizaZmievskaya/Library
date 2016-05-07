<?php

$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$stmt = $db->prepare("DELETE FROM readers WHERE reader_id = '$id'");
$stmt->execute();
echo json_encode(['status'=>'success']);//NEVEDOMAYA HUJNYA