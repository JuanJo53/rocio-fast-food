<?php
    include '../../model/Sale.php'; 
    
    $saleId = $_GET['saleId'];

    function showSingleSaleDetail($saleId){
        $sale = new Sale;
        $sales = $sale->getSaleProducts($saleId);
        $saleData = $sale->getSaleById($saleId);
        if(!empty($saleData)){
            while($row=$saleData->fetch_array()){
                $client=$row['cl_cliente'];
                $employee=$row['usr_nombre_completo'];
                $saleTotal=$row['ven_total'];
                $saleDate=$row['ven_fecha'];
            }
        }
        $salesHtml="
        <center><h1>COMPROBANTE DE VENTA</h1></center>
        <center><p><b>Cliente: </b>".$client."<b>&nbsp;&nbsp;&nbsp;&nbsp; Empleado: </b>".$employee."</p></center>
        <center><p><b>Total: </b>".$saleTotal." Bs.<b>&nbsp;&nbsp;&nbsp;&nbsp; Fecha: </b>".date("d/m/Y", strtotime($saleDate))."</p></center>
        <center><h2>Detalle de Productos</h2></center>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ARTICULO</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>";
        if(!empty($sales)){
            while($row=$sales->fetch_array()){
                $salesHtml.="
                <tr>
                    <th scope='row'>".$row['dv_id']."</th>
                    <td>".$row['prod_nombre']."</td>
                    <td>".$row['prod_precio']." bs</td>
                    <td>".$row['dv_cantidad']."</td>
                    <td>".$row['dv_subtotal']." bs</td>
                </tr>";
            }
        }
        $salesHtml.="
            </tbody>
        </table>";
        return $salesHtml;
    }
    
    header("Content-Type: application/xls");
    $filename="ComprobanteVenta".date('d-m-Y').'.xls';
    header("Content-Disposition: attachment; filename=".$filename);
    echo showSingleSaleDetail($saleId);

?>