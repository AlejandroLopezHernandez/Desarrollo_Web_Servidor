<?php 
session_start(); // Iniciar la sesión 
// Verificar si se ha seleccionado un libro 
if (isset($_GET['libro'])) { 
    //Sanitizar la entrada
    $libro = filter_input(INPUT_GET,'libro',FILTER_SANITIZE_SPECIAL_CHARS);  
    // Agregar el libro al carrito (array de sesión) 
    if (!isset($_SESSION['carrito'])) {
         $_SESSION['carrito'] = array(); // Inicializar carrito si no existe 
        } 
        // Añadir el libro al carrito 
        $_SESSION['carrito'][] = $libro;
        // Mostrar mensaje de éxito 
        echo "<h1>Libro Comprado!</h1>"; 
        echo "<p> Has comprado: <strong>" . htmlspecialchars($libro)."</strong></p>"; 
        echo '<p> <a href="index_tienda.html">Seguir comprando</a></p>'; 
    } else {  
        echo "<h1>Error</h1>"; 
        echo "<p>No se ha seleccionado ningún libro.</p>"; 
        echo '<p><a href="index_tienda.html">Volver a la tienda</a></p>';
     } 
        ?>