<?php
    include '../../model/Sale.php';

    session_start(); 
    function showSingleSaleInvoice(){
        $userId=$_SESSION['CODIGO'];
        $sale = new Sale;
        $lastSaleIdResponse = $sale->getLastSale($userId);
        if(!empty($lastSaleIdResponse)){
            while($row=$lastSaleIdResponse->fetch_array()){
                $lastSaleId=$row['MAX(VEN_ID)'];
            }
        }
        $sales = $sale->getSaleProducts($lastSaleId);
        $saleData = $sale->getSaleById($lastSaleId);
        if(!empty($saleData)){
            while($row=$saleData->fetch_array()){
                $client=$row['CLI_NOMBRE'];
                $clientNit=$row['CLI_NIT'];
                $employee=$row['USR_NOMBRES'];
                $saleTotal=$row['VEN_TOTAL'];
                $saleDate=$row['VEN_FECHA'];
            }
        }

        $salesHtml="
        <center><h1>Rocio Fast Food</h1></center>
        <center><h4>FACTURA VENTA #".$lastSaleId."</h4></center>
        <center><p><b>Cliente: </b>".$client."<b>&nbsp;&nbsp;&nbsp;&nbsp; NIT/CI: </b>".$clientNit."</p></center>
        <center><p><b>Empleado: </b>".$employee."</p></center>
        <center><p><b>Total: </b>".$saleTotal." Bs.<b>&nbsp;&nbsp;&nbsp;&nbsp; Fecha: </b>".date("d/m/Y", strtotime($saleDate))."</p></center>
        <center><h2>Detalle de Productos</h2></center>
        <center><table>
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
                    <th scope='row'>".$row['DV_ID']."</th>
                    <td>".$row['ART_NOMBRE']."</td>
                    <td>".$row['ART_PRECIO']."</td>
                    <td>".$row['DV_CANTIDAD']."</td>
                    <td>".$row['DV_SUBTOTAL']."</td>
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