<?php
/**
 * Created by PhpStorm.
 * User: mdalmasso
 * Date: 2/3/2017
 * Time: 10:34 AM
 */

require_once ("./config.php");



//set $ip $hostname and $tag var
(!empty($_GET["tag"])) ? $tag = $_GET["tag"]:$tag = "";
(!empty($dbsocket) && empty($dbhost) && empty($dbport)) ? $dsn = "mysql:unix_socket=$dbsocket;dbname=$dbname;charset=$dbcharset;" : $dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=$dbcharset;";

//clean **ALL** records from DB
try {
    $dbh = new PDO($dsn, $dbuser, $dbpwd);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $query = $dbh->prepare("DELETE FROM dip_ip;");
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_BOTH);
    if ($query ->rowCount() == 0){
        echo "No records founds for deletion!";
    }
    else echo "Deleted ".$drows = $query->rowCount()." records";
    $dbh = NULL;
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
