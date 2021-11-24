<?php
    include '../../model/Sale.php';
    
    echo showSalesSumByProducts();

    function showSalesSumByProducts(){
        $sale = new Sale;
        $salesData = $sale->getSalesSumByProduct();
        $data = array();
        if(!empty($salesData)){
            while($row=$salesData->fetch_array()){
                $data[] = $row;
            }
        }
        return json_encode($data);
    }

?>