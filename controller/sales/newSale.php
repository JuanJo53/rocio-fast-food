<?php
    include '../../model/Sale.php';
    include '../../model/Product.php';
    include '../../model/Client.php';

    function addSale(){
        session_start(); 
        $userId=$_SESSION['CODIGO'];
        $clientNit=$_POST['saleCliId'];
        $prodsData=$_POST['prodsList'];
        $products=json_decode($prodsData);    
        // $date=date('Y-m-d');
        $date=date('Y-m-d');
        $total=0;
        $stockVerif=false;
        $procesStatus='false';
        $newStocks=array();
        
        //Adding new client if needed.
        $client = new Client;
        if (isset($_POST['saleCliName'])) {
            $clientName=$_POST['saleCliName'];        
            $result = $client->newClient($clientName,$clientNit);
        }
        $clientResponse = $client->getClientByNit($clientNit);
            while($row=$clientResponse->fetch_array()){
                $clientId=$row['cl_id'];
            }

        //Adding sale procedure starts here
        $sale = new Sale;        
        $product = new Product;

        //Verify stock availability of products
        for($i=0;$i<sizeof($products);$i++){
            $stocksVerifResponse = $product->getProductStock($products[$i]->prodId);
            if(!empty($stocksVerifResponse)){
                while($row=$stocksVerifResponse->fetch_array()){
                    $currentProdStock=$row['prod_existencia'];
                }
            }
            $stockDiference = $currentProdStock-($products[$i]->quantity);
            if($stockDiference<0){
                $stockVerif=false;
                break;
            }else{
                $stockVerif=true;
            }
            array_push($newStocks,$stockDiference);
        }
        if($stockVerif==true){
            $newSaleResult = $sale->newSale($date,$userId,$clientId,$total);
            $lastSaleIdResponse = $sale->getLastSale($userId);
            if(!empty($lastSaleIdResponse)){
                while($row=$lastSaleIdResponse->fetch_array()){
                    $lastSaleId=$row['MAX(vent_id)'];
                }
            }
        
            for($i=0;$i<sizeof($products);$i++) {
                $productData = $product->getProductPrice($products[$i]->prodId);
                if(!empty($productData)){
                    while($row=$productData->fetch_array()){
                        $price=$row['prod_precio'];
                    }
                    $subtotal=$price*$products[$i]->quantity;
                    $total+=$subtotal;
    
                    $newSaleDetailResult = $sale->newSaleDetail($products[$i]->prodId,$products[$i]->quantity,$lastSaleId,$subtotal);    
                    $newStock=$newStocks[$i];
                    $updateStockResponse = $product->updateProductStock($products[$i]->prodId,$newStock);
                }
            }
            $newSaleTotalUpdateResponse = $sale->updateLastSaleTotal($lastSaleId,$total);
            $procesStatus='true';
        }else{
            $procesStatus='false';
        }
        return $procesStatus;
    }

    echo addSale();
    // header('Location: ../../controller/sales/saleInvoice.php');
?>