<?php
    include '../../model/Role.php';
    
    function removeRol(){
        $rolId=$_POST['rol_idD'];
        $rol = new Role;
        $response = $rol->deleteRol($rolId);
        return $response;
    }
    echo removeRol();
    
    header('Location: ../../view/rols.php');

?>