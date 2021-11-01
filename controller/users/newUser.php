<?php
    include '../../model/User.php';

    $name=$_POST['usr_name'];
    $phone=$_POST['usr_phone'];
    $direct=$_POST['usr_direct'];
    $email=$_POST['usr_email'];
    $username=$_POST['usr_username'];
    $password=$_POST['usr_password'];
    $type=$_POST['usr_type'];

    $user = new User;
    $result = $user->newUser($name,$direct,$phone,$email,$username,$password,$type);
    echo $result;
    header('Location: ../../view/users.php');

?>