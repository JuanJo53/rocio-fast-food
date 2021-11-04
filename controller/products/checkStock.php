<?php
    include '../../model/Product.php';

    function showLowStockProducts(){
        $product = new Product;
        $products = $product->getAllLowStockProducts();
        $productsHtml='false';        
        if(!empty($products)){
            // $productsHtml='true';        
            $productsHtml="Los productos - ";
            while($row=$products->fetch_array()){
                $productsHtml.=$row['prod_nombre']." -";
            }
            $productsHtml.=" se estan agotando!";
        }
        return $productsHtml;
    }

    echo showLowStockProducts();

?>