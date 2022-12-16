<?php
session_start();
if (empty($_SESSION['mail'])) {
    # Lo redireccionamos al formulario de inicio de sesión
    header("Location: ../login.php");
    # Y salimos del script
    exit();
}
 global $conn;
 $conn= new PDO("mysql:host=localhost; dbname=miguelon", "root" , "");
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 try{
 $sql= "SELECT nombre from yacimient";
 $resultado = $conn->prepare($sql);
 $resultado->execute();
 $cont=0;
 while($busqueda= $resultado->fetch(PDO::FETCH_ASSOC)){

    if ($_POST['nombre']==$busqueda['nombre']){
        $cont++;
    }
}

 if($cont==0){
    $mensaxe='OK'; 
    echo json_encode($mensaxe);
 }else{
    $mensaxe='NO';
    echo json_encode($mensaxe);
 }
}catch (PDOException $e) {
    $problema="Hubo un error: ". $e->getMessage();
    $erro['resultado']=$problema;
    echo json_encode($erro);
    }
    
 ?>