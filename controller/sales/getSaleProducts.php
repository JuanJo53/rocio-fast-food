<?php
    include '../../model/Sale.php';
    include '../../model/Product.php';

    $saleId=$_POST['saleDetId'];
    $sale = new Sale;
    $products = $sale->getSaleProducts($saleId);
    $productsHtml='';        
    if(!empty($products)){
        while($row=$products->fetch_array()){
            $productsHtml.="
                <tr>
                    <th scope='row'>".$row['dv_id']."</th>
                    <td>".$row['prod_nombre']."</td>
                    <td>".$row['prod_precio']."</td>
                    <td>".$row['dv_cantidad']."</td>
                    <td>".$row['dv_subtotal']."</td>
                </tr>";
        }
    }else{
        $productsHtml.="<tr><th style='color:red';>¡No hay nada que mostrar!</th></tr>";
    }
    echo $productsHtml;
?>