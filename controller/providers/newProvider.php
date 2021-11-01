<?php
    include '../../model/Provider.php';

    $name=$_POST['prov_name'];
    $email=$_POST['prov_email'];
    $phone=$_POST['prov_phone'];
    $direction=$_POST['prov_direct'];

    $provider = new Provider;
    $result = $provider->newProvider($name,$email,$phone,$direction);
    echo $result;
    header('Location: ../../view/providers.php');

?>