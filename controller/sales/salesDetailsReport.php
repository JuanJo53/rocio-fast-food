<?php
    include '../../model/Sale.php'; 
    
    $sDate = $_GET['startDate'];
    $sArray = explode('/', $sDate);
    $sTemp = $sArray[0];
    $sArray[0] = $sArray[1];
    $sArray[1] = $sTemp;
    unset($sTemp);
    $newSDate = implode('/', $sArray);
    
    $eDate = $_GET['endDate'];
    $eArray = explode('/', $eDate);
    $eTmp = $eArray[0];
    $eArray[0] = $eArray[1];
    $eArray[1] = $eTmp;
    unset($eTmp);
    $newEDate = implode('/', $eArray);

    $startDate=date("Y-m-d", strtotime(strtr($newSDate,'/', '-')));
    $endDate=date("Y-m-d", strtotime(strtr($newEDate,'/', '-')));

    function showSalesDetailsDate($startDate,$endDate,$eDate,$sDate){
        $sale = new Sale;
        $sales = $sale->getSalesDetails($startDate,$endDate);
        $salesHtml="
        <center><h1>REPORTE DE VENTAS DETALLADO</h1></center>
        <center><h4><i>Este reporte muestra los detalles de venta por articulo incluido en cada venta registrada.</i></h4></center>
        <center><h3>de ".$sDate." a ".$eDate."</h3></center>
        <table>
            <thead>
                <tr>
                    <th>ID VENTA</th>
                    <th>ID DETALLE DE VENTA</th>
                    <th>EMPLEADO</th>
                    <th>CLIENTE</th>
                    <th>NIT CLIENTE</th>
                    <th>ARTICULO</th>
                    <th>CANTIDAD</th>
                    <th>SUBTOTAL</th>
                    <th>TOTAL</th>
                    <th>FECHA</th>
                </tr>
            </thead>
            <tbody>";
        if(!empty($sales)){
            while($row=$sales->fetch_array()){
                $salesHtml.="
                <tr>
                    <td>".$row['vent_id']."</td>
                    <td>".$row['dv_id']."</td>
                    <td>".$row['usr_nombre_completo']."</td>
                    <td>".$row['cl_cliente']."</td>
                    <td>".$row['cl_documento']."</td>
                    <td>".$row['prod_nombre']."</td>
                    <td>".$row['dv_cantidad']."</td>
                    <td>".$row['dv_subtotal']."</td>
                    <td>".$row['ven_total']."</td>
                    <td>".date("d/m/Y", strtotime($row['ven_fecha']))."</td>
                </tr>";
            }
        }
        $salesHtml.="
            </tbody>
        </table";
        return $salesHtml;
    }
    
    header("Content-Type: application/xls");
    $filename="ReporteDetalleVentas_".date('d-m-Y').'.xls';
    header("Content-Disposition: attachment; filename=".$filename);
    echo showSalesDetailsDate($startDate,$endDate,$eDate,$sDate);

?>