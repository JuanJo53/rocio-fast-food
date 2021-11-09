<?php
    include '../../model/Role.php';
    
    function showRolDetails(){
        $rolId=$_GET['rol_id'];
        $rol = new Role;
        $rolData = $rol->getRolById($rolId);
        $response=$rolData->fetch_assoc();
        return json_encode($response);
    }
    echo showRolDetails();

?>