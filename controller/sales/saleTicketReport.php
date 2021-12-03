<?php
    include '../../model/Sale.php';

    session_start(); 
    function showSingleSaleTicket(){
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
                $employee=$row['usr_nombre_completo'];
                $saleTotal=$row['ven_total'];
                $saleDate=$row['ven_fecha'];
            }
        }
        $salesHtml="
        <center><h1>COMANDA - TICKET DE VENTA</h1></center>
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
    $filename="TicketVenta".date('d-m-Y').'.xls';
    header("Content-Disposition: attachment; filename=".$filename);
    echo showSingleSaleTicket();

    // header('Location: ../../view/sales.php');
?>