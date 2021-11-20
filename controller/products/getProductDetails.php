<?php
    include '../../model/Product.php';
    
    function showProductDetails(){
        $productId=$_GET['prod_id'];
        $product = new Product;
        $productData = $product->getProductById($productId);
        $response=$productData->fetch_assoc();
        $response['prod_imagen']=base64_encode($response['prod_imagen']);
        return json_encode($response);
    }
    echo showProductDetails();

?>