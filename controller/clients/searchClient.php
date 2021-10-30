<?php
    include '../../model/Client.php';

    $clientNit = $_POST['clientNit'];

    echo searchClient($clientNit);

    function searchClient($clientNit){
        $client = new Client;
        $clientResponse = $client->getClientByNit($clientNit);
        $salesHtml='';
        if(!empty($clientResponse)){
            while($row=$clientResponse->fetch_array()){
                $clientName=$row['cl_cliente'];
            }
            $salesHtml.=$clientName;            
        }else{
            $salesHtml.="";
        }
        return $salesHtml;
    }

?>