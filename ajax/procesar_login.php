<?php
session_start();
require_once "../inc/config.php";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header("Content-Type: application/json");
    $array_devolver=[];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];

    $buscar_user = $con->prepare("SELECT * FROM usuarios WHERE email = ? LIMIT 1");
    $buscar_user->bindParam(1, $email, PDO::PARAM_STR);
    $buscar_user->execute();

    if($buscar_user->rowCount() == 1){
        $user = $buscar_user->fetch(PDO::FETCH_ASSOC);
        $user_id = (int) $user['user_id'];
        $hash = (string) $user['password'];
        
        if(password_verify($password,$hash)){
            $_SESSION['user_id']=$user_id;
            $array_devolver['redirect'] ='http://localhost/sistema-login/admin.php';
        }else{
            $array_devolver['error']="Los datos no son validos.";
        }

    }else{
      $array_devolver['error']="No tienes cuenta. <a href='http://localhost/sistema-login/registro.php'>Nuevo cuenta</a>";
    }

    echo json_encode($array_devolver);

}else{
    exit("Fuera de aquí");
}


?>