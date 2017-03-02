<?php
/**
 * Created by PhpStorm.
 * User: mdalmasso
 * Date: 2/3/2017
 * Time: 12:38 AM
 */

require_once ("./config.php");


if(!empty($_ENV["REMOTE_ADDR"])) {

    //set $ip $hostname and $tag var
    $ip = $_ENV["REMOTE_ADDR"];
    $hostname = gethostbyaddr($ip);
    (!empty($_GET["tag"])) ? $tag = $_GET["tag"]:$tag = "";
    (!empty($dbsocket) && empty($dbhost) && empty($dbport)) ? $dsn = "mysql:unix_socket=$dbsocket;dbname=$dbname;charset=$dbcharset;" : $dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=$dbcharset;";

    //write info into DB
    try {
        $dbh = new PDO($dsn, $dbuser, $dbpwd);
        // set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $dbh->prepare("INSERT INTO dip_ip (ip_address, ip_datetime, ip_hostname, ip_machinetag) VALUES (?,NOW(6),?,?)");
        $query->execute([$ip,$hostname,$tag]);
        $dbh = NULL;
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
else {
    die;
}