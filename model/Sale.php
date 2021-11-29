<?php
include_once 'DataBase.php';
	class Sale extends DB{
		public function getAllSales($startDate,$endDate){
			$sql = "SELECT v.vent_id, u.usr_nombre_completo, c.cl_cliente, c.cl_documento, a.prod_nombre, dv.dv_cantidad, v.ven_total, v.ven_fecha
					FROM ventas v, detalle_venta dv, usuarios u, clientes c, productos a
					WHERE v.vent_id=dv.vent_id 
					AND v.usr_id=u.usr_id 
					AND v.cl_id=c.cl_id 
					AND dv.prod_id=a.prod_id
					AND dv.vent_id=v.vent_id
					AND v.ven_fecha BETWEEN '$startDate' and '$endDate'
					AND dv.vent_id=v.vent_id
					AND v.ven_estado=1
					GROUP BY v.vent_id
					ORDER BY v.vent_id DESC";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getSalesDetails($startDate,$endDate){
			$sql = "SELECT v.vent_id, dv.dv_id, u.usr_nombre_completo, c.cl_cliente, c.cl_documento, a.prod_nombre, dv.dv_cantidad, dv.dv_subtotal, v.ven_fecha, v.ven_total
					FROM ventas v, detalle_venta dv, usuarios u, clientes c, productos a
					WHERE v.vent_id=dv.vent_id 
					AND v.usr_id=u.usr_id 
					AND v.cl_id=c.cl_id 
					AND dv.prod_id=a.prod_id
					AND dv.vent_id=v.vent_id
					AND v.ven_fecha BETWEEN '$startDate' and '$endDate'
					AND dv.vent_id=v.vent_id
					ORDER BY v.vent_id ASC";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getSaleById($id){
			$sql = "SELECT v.vent_id, u.usr_nombre_completo,c.cl_documento, c.cl_cliente, a.prod_nombre, dv.dv_cantidad, v.ven_total, v.ven_fecha 
					FROM ventas v, detalle_venta dv, usuarios u, clientes c, productos a
					WHERE v.vent_id=dv.vent_id 
					AND v.usr_id=u.usr_id 
					AND v.cl_id=c.cl_id 
					AND dv.prod_id=a.prod_id
					AND v.vent_id='$id'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getSalesCount($startDate,$endDate){
			$sql = "SELECT v.ven_fecha, COUNT(v.ven_fecha)
					FROM ventas v
					WHERE v.ven_estado=1					
					AND v.ven_fecha BETWEEN '$startDate' and '$endDate'
					GROUP BY v.ven_fecha";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getSalesSumByProduct($startDate,$endDate){
			$sql = "SELECT p.prod_id, p.prod_nombre, SUM(dv.dv_cantidad), 
						ROUND(( SUM(dv.dv_cantidad) / ( 
							SELECT SUM( dv.dv_cantidad )
							FROM detalle_venta dv, productos p
							WHERE dv.dv_estado=1					
							AND dv.prod_id=p.prod_id ) * 100 ), 2)
					FROM ventas v, productos p, detalle_venta dv
					WHERE dv.dv_estado=1
					AND dv.prod_id=p.prod_id
					AND v.vent_id=dv.vent_id
					AND v.ven_fecha BETWEEN '$startDate' and '$endDate'
					GROUP BY p.prod_nombre";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function getSaleProducts($id){
			$sql = "SELECT dv.dv_id, a.prod_nombre, a.prod_precio, dv.dv_cantidad, dv.dv_subtotal
					FROM detalle_venta dv, productos a
					WHERE dv.prod_id=a.prod_id
					AND dv.vent_id='$id'";
			$result = $this->connect()->query($sql);
			// if($result->num_rows>0){
			// }else{
			// 	return false;
			// }
			return $result;
		}
		public function updateSale($date, $idSale, $idCli, $total, $idProd, $quantity){
			$sql = "UPDATE ventas 
					SET ven_fecha='$date',ID_CATEGORIA='$idSale',cl_id='$idCli',ven_total='$total'
					WHERE vent_id='$id';
					UPDATE detalle_venta 
					SET prod_id='$idProd',dv_cantidad='$quantity',dv_subtotal='$total'
					WHERE vent_id='$id';";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function deleteSale($id){
			$sql = "UPDATE ventas SET ven_estado=0 WHERE vent_id = '$id';";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function deleteSaleDetail($id){
			$sql = "UPDATE detalle_venta SET dv_estado=0 WHERE vent_id = '$id';";
			$result = $this->connect()->query($sql);
			return $result;
		}
		public function newSale($date,$idUser,$idClient,$total){
			$sql = "INSERT INTO ventas(ven_fecha, usr_id, cl_id, ven_total, ven_estado) 
						VALUES ('$date','$idUser','$idClient','$total', 1);";
			$result = $this->connect();
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function newSaleDetail($idProd,$quantity,$idSale,$total){			
			$sql = "INSERT INTO detalle_venta(prod_id, dv_cantidad, vent_id, dv_subtotal, dv_estado) 
						VALUES ('$idProd','$quantity','$idSale','$total', 1);";			
			$result = $this->connect();			
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
		public function getLastSale($usrId){			
			$sql = "SELECT MAX(vent_id)
					FROM ventas
					WHERE usr_id = '$usrId'";
			$result = $this->connect()->query($sql);
			if($result->num_rows>0){
				return $result;
			}else{
				return false;
			}
		}
		public function updateLastSaleTotal($id,$total){			
			$sql = "UPDATE ventas 
					SET ven_total='$total'
					WHERE vent_id='$id';";
			$result = $this->connect()->query($sql);
			if(mysqli_query($result, $sql)){
				return 'Exito!';
			}else{
				return "Error: " . $sql . "<br>" . mysqli_error($result);
			}
		}
	}
?>