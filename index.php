<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilos.css">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
    session_destroy();
    session_start();
?>
    <main>
        <h1>Formulario</h1>
        <form action="login.php" method="get">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario"><br>
            <label for="pass">Contraseña</label>
            <input type="password" name="pass" id="pass"><br>
            <button>Enviar</button>
        </form>
    </main>
</body>
</html>