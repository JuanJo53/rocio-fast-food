<?php
    include '../model/Sale.php';
    include '../model/Client.php';
    include '../model/Product.php';
    
    function showSales(){
        $sale = new Sale;
        $sales = $sale->getAllSales();
        $salesHtml='';
        if(!empty($sales)){
            while($row=$sales->fetch_array()){
                $salesHtml.="
                <tr>
                    <th scope='row'>".$row['VEN_ID']."</th>
                    <td>".$row['USR_NOMBRES']."</td>
                    <td>".$row['CLI_NOMBRE']."</td>
                    <td>".$row['VEN_TOTAL']."</td>
                    <td>".date("d/m/Y", strtotime($row['VEN_FECHA']))."</td>
                    <td>
                        <button class='btn btn-info openDetailModal' data-bs-toggle='modal' data-bs-target='#prodDetailModal' role='button'  id='saleIdDetails' name='saleIdDetails' data-id='".$row['VEN_ID']."'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-card-list' viewBox='0 0 16 16'>
                                <path d='M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z'/>
                                <path d='M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z'/>
                            </svg>
                        </button>
                    </td>";
                if($_SESSION['TIPO']=='admin'){
                    $salesHtml.="                    
                        <td>
                            <button class='btn btn-danger openDeleteModal' data-bs-toggle='modal' data-bs-target='#delSaleModal' role='button' id='saleIdDel' name='saleIdDel' data-id='".$row['VEN_ID']."'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                    <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                </svg>
                            </button>
                        </td>
                    </tr>";
                }
            }
        }else{
            $salesHtml.="<tr><th style='color:red';>¡No hay nada que mostrar!</th></tr>";
        }
        return $salesHtml;
    }
    function showClients(){
        $client = new Client;
        $clients = $client->getAllClients();
        $clientsHtml='';        
        if(!empty($clients)){
            while($row=$clients->fetch_array()){
                $clientsHtml.="
                    <option value='".$row['CLI_ID']."'>".$row['CLI_NIT']."</option>";
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
                    <option value='".$row['ART_ID']."'>".$row['ART_NOMBRE']."</option>";
            }
        }else{
            $productsHtml.="<option style='color:red';>¡No hay nada que mostrar!</option>";
        }
        return $productsHtml;
    }

?>