<?php




class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "lanubede_info_app";
    private static $dbUsername = "root";
    private static $dbUserpassword = "Desarrollo#1";
    private static $connection = null;


    
    public static function connect()
    {

        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbUserpassword, 
              array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES,false
                ));
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }

        return self::$connection;
    }
    



    public static function getHost(){
        $array["dbHost"] = self::$dbHost;
        $array["dbName"] = self::$dbName;
        $array["dbUsername"] = self::$dbUsername;
        $array["dbUserpassword"] = self::$dbUserpassword;
        return $array;
    }



    
    public static function disconnect()
    {
        self::$connection = null;
    }

}
?>
