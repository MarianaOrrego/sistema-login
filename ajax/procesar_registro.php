<?php
session_start();
require_once "../inc/config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header("Content-Type: application/json");
    $array_devolver=[];
    $email = strtolower($_POST['email']);

    $buscar_user = $con->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $buscar_user->bindParam(1, $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if($buscar_user->rowCount() == 1){
        $array_devolver['error'] = "Este mail ya existe";
        $array_devolver['is_login']= false;
    }else{
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        $nuevo_user = $con->prepare("INSERT INTO usuarios (email, password) VALUES(?,?)");
        $nuevo_user->bindParam(1, $email, PDO::PARAM_STR);
        $nuevo_user->bindParam(2, $password, PDO::PARAM_STR);
        $nuevo_user->execute();

        $user_id = $con->lastInsertId();
        $_SESSION['user_id']= (int) $user_id;
        $array_devolver['redirect']= 'http://localhost/sistema-login/admin.php'; 
        $array_devolver['is_login']= true;
    }

    echo json_encode($array_devolver);

}else{
    exit("Fuera de aquí");
}


?>