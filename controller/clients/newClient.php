<?php
    include '../../model/Client.php';

    $name=$_POST['client_name'];
    $nit=$_POST['client_nit'];
    
    $origin=false;

    if(isset($_POST['client_phone'])){
        $phone=$_POST['client_phone'];
        $origin=true;
    }else{
        $origin=false;
        $phone=0;
    }
    if(isset($_POST['client_email'])){        
        $email=$_POST['client_email'];
        $origin=true;
    }else{
        $email="";
        $origin=false;
    }

    $client = new Client;
    $result = $client->newClient($name,$nit,$phone,$email);

    if($origin==false){
        header('Location: ../../view/sales.php');
    }
    // echo $result;

?>