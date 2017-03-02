<?php
/**
 * Created by PhpStorm.
 * User: mdalmasso
 * Date: 2/3/2017
 * Time: 9:55 AM
 */

require_once ("./config.php");



    //set $ip $hostname and $tag var
    (!empty($_GET["tag"])) ? $tag = $_GET["tag"]:$tag = "";
    (!empty($dbsocket) && empty($dbhost) && empty($dbport)) ? $dsn = "mysql:unix_socket=$dbsocket;dbname=$dbname;charset=$dbcharset;" : $dsn = "mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=$dbcharset;";

    //get info from DB
    try {
        $dbh = new PDO($dsn, $dbuser, $dbpwd);
        // set the PDO error mode to exception
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $query = $dbh->prepare("SELECT ip_address,DATE_FORMAT(MAX(ip_datetime),'%Y-%m-%d %T.%f'),ip_hostname,ip_machinetag FROM dip_ip WHERE ip_machinetag = ?");
        $query->execute([$tag]);
        $rows = $query->fetchAll(PDO::FETCH_BOTH);
        if ($rows[0][0] == NULL){
            echo "No records Found!";
        }
        else echo "IP: ".$rows[0][0]." | DATE/TIME: ".$rows[0][1]." | HOSTNAME: ".$rows[0][2].(!empty($rows[0][3])?" | MACHINE TAG= ".$rows[0][3]:" | MACHINE TAG= NOT SET");
        $dbh = NULL;
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
