<?php 

class MySQL {

	private $_conexion;

	public function __construct() {
		$this->_conexion = new mysqli("localhost", "root", "", "crudAndres");
	}

	public function consult($sql) {
		$datos = $this->_conexion->query($sql);
		return $datos;
	}

	public function insert($sql) {
		$datos = $this->_conexion->query($sql);
		return $this->_conexion->insert_id;
	}

	public function update($sql) {
		$this->_conexion->query($sql);
	}

	public function delete($sql) {
		$this->_conexion->query($sql);
	}

	public function dropStatus($sql) {
		$datos = $this->_conexion->query($sql);
		return $this->_conexion->insert_id;
	}
}

?>