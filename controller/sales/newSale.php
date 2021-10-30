<?php
    include '../../model/Sale.php';
    include '../../model/Product.php';
    include '../../model/Client.php';

    session_start(); 
    $userId=$_SESSION['CODIGO'];
    $clientNit=$_POST['saleCliId'];
    $prodsData=$_POST['prodsList'];
    $products=json_decode($prodsData);    
    // $date=date('Y-m-d');
    $date=date('Y-m-d', strtotime('-1 day'));
    $total=0;

    $client = new Client;
    $clientResponse = $client->getClientByNit($clientNit);
    if(!empty($clientResponse)){
        while($row=$clientResponse->fetch_array()){
            $clientId=$row['cl_id'];
        }
    }

    $sale = new Sale;
    $newSaleResult = $sale->newSale($date,$userId,$clientId,$total);
    $lastSaleIdResponse = $sale->getLastSale($userId);
    if(!empty($lastSaleIdResponse)){
        while($row=$lastSaleIdResponse->fetch_array()){
            $lastSaleId=$row['MAX(vent_id)'];
        }
    }
    print_r($lastSaleId);
    for($i=0;$i<sizeof($products);$i++) {
        $product = new Product;
        $productData = $product->getProductPrice($products[$i]->prodId);
        if(!empty($productData)){
            while($row=$productData->fetch_array()){
                $price=$row['prod_precio'];
            }
            $subtotal=$price*$products[$i]->quantity;
            $total+=$subtotal;
            $newSaleDetailResult = $sale->newSaleDetail($products[$i]->prodId,$products[$i]->quantity,$lastSaleId,$subtotal);
            $productStockResponse = $product->getProductStock($products[$i]->prodId);
            if(!empty($productStockResponse)){
                while($row=$productStockResponse->fetch_array()){
                    $prodStock=$row['prod_existencia'];
                }
            }
            $newStock=$prodStock-($products[$i]->quantity);
            $updateStockResponse = $product->updateProductStock($products[$i]->prodId,$newStock);
        }
    }
    $newSaleTotalUpdateResponse = $sale->updateLastSaleTotal($lastSaleId,$total);
    
    // header('Location: ../../controller/sales/saleInvoice.php');
?>