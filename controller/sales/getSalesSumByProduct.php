<?php
    include '../../model/Sale.php';

    $sDate = $_POST['startDate'];    
    $sArray = explode('/', $sDate);
    $sTemp = $sArray[0];
    $sArray[0] = $sArray[1];
    $sArray[1] = $sTemp;
    unset($sTemp);
    $newSDate = implode('/', $sArray);
    
    $eDate = $_POST['endDate'];
    $eArray = explode('/', $eDate);
    $eTmp = $eArray[0];
    $eArray[0] = $eArray[1];
    $eArray[1] = $eTmp;
    unset($eTmp);
    $newEDate = implode('/', $eArray);

    $startDate=date("Y-m-d", strtotime(strtr($newSDate,'/', '-')));
    $endDate=date("Y-m-d", strtotime(strtr($newEDate,'/', '-')));
    
    echo showSalesSumByProducts($startDate,$endDate);

    function showSalesSumByProducts($startDate,$endDate){
        $sale = new Sale;
        $salesData = $sale->getSalesSumByProduct($startDate,$endDate);
        $data = array();
        if(!empty($salesData)){
            while($row=$salesData->fetch_array()){
                $data[] = $row;
            }
        }
        return json_encode($data);
    }

?>