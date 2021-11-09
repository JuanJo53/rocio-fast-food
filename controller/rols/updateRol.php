<?php
    include '../../model/Role.php';

    function updateRolData(){   
        $rolId=$_POST['rol_idEdit'];
        $name=$_POST['rol_nameEdit'];
    
        $rol = new Role;
        $response = $rol->updateRol($rolId,$name);
        return $response;
    }
    echo updateRolData();
    
    header('Location: ../../view/rols.php');

?>