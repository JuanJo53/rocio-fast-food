<?php
    include '../../model/Provider.php';
    
    function showProviderDetails(){
        $provId=$_GET['prov_idDel'];
        $provider = new Provider;
        $provData = $provider->getProviderById($provId);
        $response=$provData->fetch_assoc();
        return json_encode($response);
    }
    echo showProviderDetails();

?>