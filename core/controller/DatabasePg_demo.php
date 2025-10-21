<?php
#[AllowDynamicProperties]


// Se agregó el usuario “lanubepl_userinfoapp” a la base de datos “lanubepl_infoapp”. 

class DatabasePg
{

    private static $dbName = "info_app";
    private static $dbUsername = "userinfoapp";
    private static $dbUserpassword = "infoadmin#2050";
    private static $dbHost = "127.0.0.1";
    private static $dbPort = "5432";
    private static $connection = null;


    function __construct()
    {
        $this->ddbb = self::$dbName;
        $this->user = self::$dbUsername;
        $this->pass = self::$dbUserpassword;
        $this->host = self::$dbHost;
        $this->port = self::$dbPort;
    }


    public static function connectPg()
    {
        if (self::$connection == null) {
            // try
            // {
            //   self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbUserpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // }
            // catch(PDOException $e)
            // {
            //     die($e->getMessage());
            // }

            try {
                self::$connection = new PDO("pgsql:host=" . self::$dbHost . ";dbname=" . self::$dbName . ";port=" . self::$dbPort, self::$dbUsername, self::$dbUserpassword);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo "Ocurrió un error con la base de datos: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
}
