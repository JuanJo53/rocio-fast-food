<?php
include_once 'DataBase.php';
	class Provider extends DB{
		public function getAllProviders(){
			$sql = "SELECT * FROM proveedores a WHERE a.prov_estado=1";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getProviderById($id){
			$sql = "SELECT * FROM proveedores WHERE prov_id = '$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}

		public function updateProvider($id,$name,$email,$phone,$direction){
			$sql = "UPDATE proveedores SET prov_proveedor='$name',prov_correo='$email',prov_contacto='$phone',prov_direccion='$direction',prov_estado=1
					WHERE prov_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteProvider($id){
			$sql = "UPDATE proveedores SET prov_estado=0 WHERE prov_id = '$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function newProvider($name,$email,$phone,$direction){
			$sql = "INSERT INTO proveedores(prov_proveedor, prov_correo, prov_contacto, prov_direccion, prov_estado) 
			VALUES ('$name','$email','$phone','$direction',1)";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}

?>