<?php
include_once 'DataBase.php';
	class Client extends DB{
		public function getAllClients(){
			$sql = "SELECT * FROM clientes";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getClientById($id){
			$sql = "SELECT * FROM clientes WHERE cl_id = '$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getClientByNit($nit){
			$sql = "SELECT * FROM clientes WHERE cl_documento = '$nit'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function updateClient($id,$name,$nit){
			$sql = "UPDATE clientes SET cl_cliente='$name',cl_documento='$nit'
					WHERE cl_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteClient($id){
			$sql = "DELETE FROM clientes WHERE cl_id = '$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function newClient($name,$nit){
			$sql = "INSERT INTO clientes(cl_cliente, cl_documento) 
					VALUES ('$name','$nit')";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}

?>