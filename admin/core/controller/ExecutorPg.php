<?php

class ExecutorPg
{

	public static function doit($sql)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_OBJ);
		$TotalReg = $stmt->rowCount();
		$data = $data!=null?$data:array([]);
		// $TotalReg = 0;
		return array($data, $TotalReg);
	}

	public static function get($sql)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $stmt->rowCount();
		$data = $data!=null?$data:array([0]);
		// $TotalReg = 0;
		return array($data, $TotalReg);
	}


	public static function getAjax($sql)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$TotalReg = $stmt->rowCount();
		// $data = $data!=null?$data:array([0]);
		// $TotalReg = 0;
		return array($data, $TotalReg);
	}

	public static function insert($sql, $values)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
			print_r($values);
			// Core::alert("<pre>".$sql."</pre>");
		}
		$stmt = $conn->prepare($sql);
		$stmt->execute($values);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// $insert_id = $conn->lastInsertId($table.'_id_seq');
		// $TotalReg = $stmt->rowCount();
		// $TotalReg = 0;
		return array($result[0], $conn);
	}


	public static function update($sql, $values)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
			print_r($values);
			// Core::alert("<pre>".$sql."</pre>");
		}
		$stmt = $conn->prepare($sql);
		$result = $stmt->execute($values);
		// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$total_result = 0;
		return array($result, $total_result);
	}

	public static function del($sql,$id)
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
			print "<pre>" . $id . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$resul = $stmt->execute([$id]);
		return $resul;

	}

	public static function setSql($sql )
	{
		$conn = DatabasePg::connectPg();

		if (Core::$debug_sql) {
			print "<pre>" . $sql . "</pre>";
		}
		$stmt = $conn->prepare($sql);
		$resul = $stmt->execute();
		return $resul;

	}
}
