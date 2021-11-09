<?php
    include '../../model/Role.php';

    $name=$_POST['rol_name'];

    $rol = new Role;
    $result = $rol->newRol($name);
    echo $result;
    header('Location: ../../view/rols.php');

?>