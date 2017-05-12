<?php
$db_user = 'apdoc';
$db_pass = 'Doc@123!';
$db_name = 'apdoc_yellowcar';

ini_set("display_errors",1);
require 'Slim/Slim.php';
date_default_timezone_set("UTC"); 
$app = new Slim();
header('Content-Type: application/json; charset=utf-8');
function getConnection()
{
    global $db_user;
    global $db_pass;
    global $db_name;
    try 
    {
        $conn = new PDO('mysql:host=localhost;dbname='.$db_name, $db_user, $db_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $e) 
    {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}
?>