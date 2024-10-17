<?php 
// Comprobar si el formulario ha sido enviado, si da true se envía
if (isset($_POST['nombre'])) { 
    //Sanitizamos la entrada de datos 
    $nombre = filter_var($_POST['nombre'],FILTER_SANITIZE_SPECIAL_CHARS);  
    // Crear una cookie con el nombre del usuario, que expira en 1 hora, 3600 segundos
    setcookie("nombre_usuario", $nombre, time() + 3600); 
    echo "Galletita creada";
} else{ 
    //Esta afirmación sólo dará true cuando se haya creado previamente la cookie, si no, no saldrá nada
if (isset($_COOKIE['nombre_usuario'])) { 
    // Mostrar el nombre si la cookie existe 
    echo "Bienvenido de nuevo, " . $_COOKIE['nombre_usuario'] . 
    "!"; 
    }  
    }
    ?>