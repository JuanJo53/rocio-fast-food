<?php
include_once 'DataBase.php';
	class Category extends DB{
		public function getAllCategories(){
			$sql = "SELECT * FROM categorias";
			$result = $this->connect()->query($sql);
			$numrows = $result->num_rows;
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getCategoryById($id){
			$sql = "SELECT * FROM categorias WHERE cat_id = '$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}

		public function updateCategory($id,$name){
			$sql = "UPDATE categorias SET cat_categoria='$name'	WHERE cat_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteCategory($id){
			$sql = "UPDATE categorias SET cat_estado=0 WHERE cat_id='$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function newCategory($name){
			$sql = "INSERT INTO categorias (cat_categoria,cat_estado) VALUES ('$name',1)";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}

?>