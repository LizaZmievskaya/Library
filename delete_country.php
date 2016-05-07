<?php
/*namespace lib;
include "db.php";*/
/*class Delete extends Db {
    public function delete(){*/
//$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
//$db->exec("SET NAMES utf8");
        //$id = $_POST['id'];
        //$conn = $this->ConnectDB();
       // $stmt = $db->prepare("DELETE FROM `countries` WHERE country_id = 1");
        //$stmt->execute();
        /*$result = $stmt->delete();
        return $result;*/
/*    }
}*/
/*$del = new Delete();
$del->delete();*/
//var_dump($del->delete());die();
//echo json_encode(['status'=>'success']);

$db = new PDO('mysql:host=localhost; dbname=lib', 'root', '123kjubrf');
$db->exec("SET NAMES utf8");
$id = $_POST['id'];
$stmt = $db->prepare("DELETE FROM countries WHERE country_id = '$id'");
$stmt->execute();
echo json_encode(['status'=>'success']);//NEVEDOMAYA HUJNYA