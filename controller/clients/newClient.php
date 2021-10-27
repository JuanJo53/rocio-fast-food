<?php
    include '../../model/Client.php';

    $name=$_POST['client_name'];
    $nit=$_POST['client_nit'];

    $client = new Client;
    $result = $client->newClient($name,$nit);

    if($origin==false){
        header('Location: ../../view/sales.php');
    }
    // echo $result;

?>