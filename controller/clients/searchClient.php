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
                $clientName=$row['CLI_NOMBRE'];
            }
            $salesHtml.="<tr><th style='color:green';>¡Cliente ".$clientName." esta registrado!</th></tr>";            
        }else{
            $salesHtml.="<tr><th style='color:red';>¡Cliente NO Registrado!</th></tr>";
        }
        return $salesHtml;
    }

?>