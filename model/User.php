<?php
	include_once 'DataBase.php';
	class User extends DB{
		public function login($user,$pass){
			$sql = 'SELECT * FROM usuarios WHERE usr_usuario="'.$user.'"';
			$result = $this->connect()->query($sql);
            return $result;
		}	
		public function getAllUsers(){
			$sql = "SELECT * FROM usuarios a WHERE a.usr_estado=1";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getUserById($id){
			$sql = "SELECT * FROM usuarios WHERE usr_id = '$id'";
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
		public function newUser($name,$direction,$phone,$email,$username,$password,$rolId){
			$sql = "INSERT INTO usuarios(usr_nombre_completo, usr_direccion, usr_contacto, usr_correo, usr_usuario, usr_password, usr_estado, rol_id) 
			VALUES ('$name','$direction','$phone','$email','$username','$password', 1,'$rolId')";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}

?>