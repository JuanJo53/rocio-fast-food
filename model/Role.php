<?php
	include_once 'DataBase.php';
	class Role extends DB{
		public function getAllRoles(){
			$sql = "SELECT * FROM roles	WHERE rol_estado=1";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getUserById($id){
			$sql = "SELECT a.usr_id, a.usr_nombre_completo, a.usr_direccion, a.usr_correo, a.usr_contacto, a.usr_usuario, a.usr_password, b.rol_id, b.rol_nombre
					FROM usuarios a, roles b 
					WHERE a.usr_id = '$id' AND a.rol_id=b.rol_id ";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}

		public function updateUser($id,$name,$direction,$phone,$email,$username,$password,$rolId){
			$sql = "UPDATE usuarios SET usr_nombre_completo='$name',usr_direccion='$direction',usr_contacto='$phone',usr_correo='$email',usr_usuario='$username',usr_password='$password',rol_id='$rolId'
					WHERE usr_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteUser($id){
			$sql = "UPDATE usuarios SET usr_estado=0 WHERE usr_id = '$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
	
		public function newUser($name,$direct,$phone,$email,$username,$password,$type){
			$sql = "INSERT INTO usuarios(usr_nombre_completo, usr_direccion, usr_correo, usr_contacto, usr_usuario, usr_password, usr_estado, rol_id) 
			VALUES ('$name','$direct','$email','$phone','$username','$password', 1,'$rolId')";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function getRolById($id){
			$sql = "SELECT * FROM roles WHERE rol_id = '$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function updateRol($id,$name){
			$sql = "UPDATE roles SET rol_nombre='$name'	WHERE rol_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function newRol($name){

			
			$sql = "INSERT INTO roles (rol_nombre, rol_estado) VALUES ('$name',1)";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteRol($id){
			$sql = "UPDATE roles SET rol_estado=0 WHERE rol_id='$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
	}

?>