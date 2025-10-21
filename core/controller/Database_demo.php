<?php
 #[AllowDynamicProperties]

class Database {
	public static $db;
	public static $con;

    private static $dbName = "comunas";
    private static $dbUsername = "admin";
    private static $dbUserpassword = "aJSyeAfFCStqncqsmGEMYYrXYdyJtOqD";
    // private static $dbUserpassword = "Desarrollo#1";
	private static $dbHost = "localhost";
    private static $connection = null;

	
	function __construct(){
		$this->ddbb=self::$dbName ;
		$this->user=self::$dbUsername ;
		$this->pass=self::$dbUserpassword ;
		$this->host=self::$dbHost ;
	}


	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		/* change character set to utf8 */
		if (!$con->set_charset("utf8")) {
			printf("", $con->error);
		} else {
			printf("", $con->character_set_name());
		}
		$con->query("set sql_mode=''");
		return $con;
	}


    public static function connectPDO()
    {
		if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUsername, self::$dbUserpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }



	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	

}
?>