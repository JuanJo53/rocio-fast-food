<?php
    include '../../model/Sale.php';

    session_start(); 
    function showSingleSaleInvoice(){
        $userId=$_SESSION['CODIGO'];
        $sale = new Sale;
        $lastSaleIdResponse = $sale->getLastSale($userId);
        if(!empty($lastSaleIdResponse)){
            while($row=$lastSaleIdResponse->fetch_array()){
                $lastSaleId=$row['MAX(vent_id)'];
            }
        }
        $sales = $sale->getSaleProducts($lastSaleId);
        $saleData = $sale->getSaleById($lastSaleId);
        if(!empty($saleData)){
            while($row=$saleData->fetch_array()){
                $client=$row['cl_cliente'];
                $clientNit=$row['cl_documento'];
                $employee=$row['usr_nombre_completo'];
                $saleTotal=$row['ven_total'];
                $saleDate=$row['ven_fecha'];
            }
        }

        $salesHtml="
        <center><h1>Rocio Fast Food</h1></center>
        <center><p><b>Direccion: </b>av. Republica Nro. 390, Zona villa victoria</p></center>
        <center><p><b>Cel: </b>  69860296</p></center>
        <center><p> La Paz - Bolivia</p></center>
        <center><b>FACTURA </b></center>
        <b>----------------------------------------------------------------------------------</b>
        <p><b>NIT: </b>3355428017</p>
        <p><b>CODIGO de FACTURA: </b>".$lastSaleId."</p>
        <b>----------------------------------------------------------------------------------</b>
        <p><b> Fecha: </b>".date("d/m/Y", strtotime($saleDate))."</p>

        <b> NIT/CI: </b>".$clientNit."</center>
        <p><b>Cliente: </b>".$client."
        <p><b>Empleado: </b>".$employee."</p>
        <b>---------------------------------------------------------------------------------</b>
        <center><h2>Detalle de Productos</h2></center>
        <center><table>
            <thead>
                <tr>
                    <th>CODIGO DETALLE DE VENTA</th>
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
        </table></center>";
        $salesHtml.="<center><img src='fakeQR.png' alt='fakeQR'></center>";
        return $salesHtml;
    }
    
    header("Content-Type: application/xls");
    $filename="Factura".date('d-m-Y').'.xls';
    header("Content-Disposition: attachment; filename=".$filename);
    echo showSingleSaleInvoice();

    // header('Location: ../../view/sales.php');
?>