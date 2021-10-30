<?php
    include '../model/Client.php';
    include '../model/Product.php';

    function showClients(){
        $client = new Client;
        $clients = $client->getAllClients();
        $clientsHtml='';        
        if(!empty($clients)){
            while($row=$clients->fetch_array()){
                $clientsHtml.="
                    <option value='".$row['cl_id']."'>".$row['cl_documento']."</option>";
            }
        }else{
            $clientsHtml.="<option style='color:red';>¡No hay nada que mostrar!</option>";
        }
        return $clientsHtml;
    }
    function showProducts(){
        $product = new Product;
        $products = $product->getAllAvailableProducts();
        $productsHtml='';        
        if(!empty($products)){
            while($row=$products->fetch_array()){
                $productsHtml.="
                    <option value='".$row['prod_id']."'>".$row['prod_nombre']."</option>";
            }
        }else{
            $productsHtml.="<option style='color:red';>¡No hay nada que mostrar!</option>";
        }
        return $productsHtml;
    }

?>