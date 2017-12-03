<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="datos.css">
    <title>Datos</title>
</head>
<body>
<?php
session_start();

if (file_exists('usuarios.xml')) {
    $xml = simplexml_load_file('usuarios.xml');
    //print_r($xml);
} else {
    echo "<h1>Error al abrir el archivo</h1>";
}


if (!isset( $_SESSION["inicio"])) {
    $user=$_GET["usuario"];
    $pass=$_GET["pass"];
    foreach ($xml as $clave => $valor) {//Objeto XML
        if ($user == $valor->login && md5($pass) == $valor->password) {//inicio de sesion
            $usuario = $valor;
            $_SESSION["inicio"] = $user ;
            if ($valor->rol == 'Administrador') {
                $_SESSION["rol"] = 'Administrador';
            }
            if ($valor->rol == 'Usuario') {
                $_SESSION["rol"] = 'Usuario';
            }
        }
    }
    if (!isset($_SESSION["inicio"])) {
        header('location:index.php');
    }
}
?>

<header>
    <h1>Datos</h1>
</header>
<aside>
    <button id="datos">Ver mis datos</button>
    <button id="salir">Salir</button>
    <?php
    if (isset($_SESSION["rol"])){
        if ($_SESSION["rol"]=='Administrador'){
            echo "<button id='datos_user'>Datos Usuarios</button>";
        }
    }
    ?>
</aside>
<div id="usuario">
    <?php
        echo "<ul>";
        foreach ($xml as  $valor2){
            if ($_SESSION["inicio"]==$valor2->login){
                foreach($valor2 as $clave3=>$valor3){
                    echo "<li>$clave3: $valor3</li>";
                }
            }
        }

        echo "</ul>";
    ?>
</div>
<div id="administrador">
    <?php
    if (isset($xml)){
        if ($_SESSION["rol"]=='Administrador') {
            foreach ($xml as $clave2 => $valor2) {
                if ($valor2->rol == 'Usuario') {
                    echo "<h1>Usuario $valor2->login</h1>";
                    echo "<ul>";
                    echo "<li>Su nombre es $valor2->nombre $valor2->apellido1  $valor2->apellido2</li>";
                    echo "<li>Su login es $valor2->login</li>";
                    echo "<li>Su contraseña es $valor2->password</li></ul><br><br>";

                }
            }
        }
    }
    ?>
</div>

<script src="jquery-3.2.1.min.js"></script>
<script>
    $(function () {
        $("#datos").on("click",function () {
            $("#usuario").toggle();
        });
        $("#datos_user").on("click",function () {
            $("#administrador").toggle();
        });
        $("#salir").on("click",function () {
            location.href='index.php';
        });
    })
</script>
</body>
</html>