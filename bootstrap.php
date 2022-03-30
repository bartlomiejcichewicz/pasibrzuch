<?php
session_start();
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']."/pasibrzuch/");
require_once(ROOT_DIR."config/src.php");
require_once(ROOT_DIR."database/database.php");
require_once(VIEWS_SRC."view.php");
require_once(CONTROLLERS_SRC."controller.php");
global $_DB;
$_DB = new Db_Connection();
if(empty($_SESSION['client_id'])){
    $_DB->conn->query("INSERT INTO `klienci`(`ordered`) VALUES (0)");
    $_SESSION['client_id'] = $_DB->conn->insert_id;
}