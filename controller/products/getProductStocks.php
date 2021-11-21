<?php
    include '../../model/Product.php';
    
    function showProductStocks(){
        $products = new Product;
        $prodsData = $products->getAllProductStocks();
        $data = array();
        if(!empty($prodsData)){
            while($row=$prodsData->fetch_array()){
                $data[] = $row;
            }
        }
        return json_encode($data);
    }
    echo showProductStocks();

?>