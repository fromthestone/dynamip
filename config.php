<?php
/**
 * Created by PhpStorm.
 * User: mdalmasso
 * Date: 2/3/2017
 * Time: 12:38 AM
 */

// MySql DB Connection: Using Host/Port or Using Socket
$dbhost = ""; //leave empty if you using socket
$dbport = ""; //optional, no used if Socket
$dbname = "dynamip"; //Your db name
$dbsocket = "/Applications/MAMP/tmp/mysql/mysql.sock"; // Path to Mysql Socket
$dbuser = "root";
$dbpwd = "toor";
$dbcharset = "utf8";
$tag = ""; // optional, you can use to recognize what machine is sending info. Can be set also through http://my.web.site/?tag=yourmachinename (it overrides the value here)