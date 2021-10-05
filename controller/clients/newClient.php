<?php
    include '../../model/Client.php';

    $name=$_POST['client_name'];
    $nit=$_POST['client_nit'];
    
    if(isset($_POST['client_phone'])){
        $phone=$_POST['client_phone'];        
    }else{
        $phone=0;
    }
    if(isset($_POST['client_email'])){        
        $email=$_POST['client_email'];
    }else{
        $email="";
    }

    $client = new Client;
    $result = $client->newClient($name,$nit,$phone,$email);
    
    // echo $result;
    // header('Location: ../../view/clients.php');

?>