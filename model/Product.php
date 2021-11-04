<?php
include_once 'DataBase.php';
	class Product extends DB{
		public function getAllProducts(){
			$sql = "SELECT a.prod_id, a.prod_descripcion, a.prod_nombre, c.cat_categoria, b.prov_proveedor, a.prod_precio, a.prod_existencia 
					FROM productos a, proveedores b, categorias c
					WHERE a.cat_id=c.cat_id AND a.prov_id=b.prov_id AND a.prod_estado=1
					ORDER BY a.prod_id ASC";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getAllAvailableProducts(){
			$sql = "SELECT a.prod_id, a.prod_nombre, c.cat_categoria, b.prov_proveedor, a.prod_precio, a.prod_existencia 
					FROM productos a, proveedores b, categorias c
					WHERE a.cat_id=c.cat_id 
					AND a.prov_id=b.prov_id
					AND a.prod_existencia>'0'
					AND a.prod_estado=1
					ORDER BY a.prod_id ASC";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getAllLowStockProducts(){
			$sql = "SELECT a.prod_id, a.prod_nombre, c.cat_categoria, b.prov_proveedor, a.prod_precio, a.prod_existencia 
					FROM productos a, proveedores b, categorias c
					WHERE a.cat_id=c.cat_id 
					AND a.prov_id=b.prov_id
					AND a.prod_existencia>'0'
					AND a.prod_existencia<'11'
					AND a.prod_estado=1
					ORDER BY a.prod_id ASC";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getProductById($id){
			$sql = "SELECT a.prod_id, a.prod_descripcion, a.prod_nombre, c.cat_id,c.cat_categoria,b.prov_id, b.prov_proveedor, a.prod_precio, a.prod_existencia 
					FROM productos a, proveedores b, categorias c 
					WHERE a.cat_id=c.cat_id AND a.prov_id=b.prov_id AND a.prod_id='$id' AND a.prod_estado=1";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getProductPrice($id){
			$sql = "SELECT a.prod_precio 
					FROM productos a
					WHERE a.prod_id='$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getProductStock($id){
			$sql = "SELECT a.prod_existencia 
					FROM productos a
					WHERE a.prod_id='$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function updateProduct($id,$name,$desc,$idCat,$idProv,$price,$stock){
			$sql = "UPDATE productos 
					SET prod_nombre='$name',prod_descripcion='$desc',cat_id='$idCat',prov_id='$idProv',prod_precio='$price',prod_existencia='$stock'
					WHERE prod_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function updateProductStock($id,$stock){
			$sql = "UPDATE productos 
					SET prod_existencia='$stock'
					WHERE prod_id='$id'";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteProduct($id){
			$sql = "UPDATE productos SET prod_estado=0 WHERE prod_id = '$id'";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function newProduct($name,$desc,$idCat,$idProv,$price,$stock){
			$sql = "INSERT INTO productos(prod_nombre, prod_descripcion, cat_id, prov_id, prod_precio, prod_existencia, prod_estado) 
					VALUES ('$name','$desc','$idCat','$idProv','$price','$stock', 1)";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}

?>