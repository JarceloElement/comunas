<?php
class ProductsType {
	public static $tablename = "products_type";

	public $id;
	public $tipo_categoria;
	public $name;
	public $cod_producto;
	public $nombre_categoria;
	public $cod_categoria;
	public $fecha_reg;


	public function __construct(){
		$this->tipo_categoria = "";
		$this->name = "";
		$this->cod_producto = "";
		$this->nombre_categoria = "";
		$this->cod_categoria = "";
		$this->fecha_reg = "";
	}

	public function add(){
		$sql = "insert into products_type (name) ";
		$sql .= "value (\"$this->name\")";
		return Executor::doit($sql);
	}

	public function addCat(){
		$sql = "INSERT into categoria_productos (nombre_categoria,cod_categoria) ";
		$sql .= "value ('$this->nombre_categoria','$this->cod_categoria')";
		return Executor::doit($sql);
	}

	public function addProd(){
		$sql = "INSERT into products_type (tipo_categoria,name,cod_producto) ";
		$sql .= "value ('$this->tipo_categoria','$this->name','$this->cod_producto')";
		return Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductsType());
	}

	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductsType());

	}
	
	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductsType());
	}

	public static function getBySQL($sql){
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductsType());
	}
}

?>