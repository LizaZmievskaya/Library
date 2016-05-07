<?php

$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$stmt = $db->prepare("DELETE FROM output WHERE output_id = '$id'");
$stmt->execute();
echo json_encode(['status'=>'success']);//NEVEDOMAYA HUJNYA