<?php 
session_start(); // Iniciar la sesión 
// Verificar si el carrito existe 
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) 
{ 
    echo "<h1>Contenido del Carrito</h1>"; 
    echo "<ul>"; 
    // Mostrar cada libro en el carrito 
    Foreach($_SESSION['carrito'] as $libro) { 
        echo "<li>" . htmlspecialchars($libro) . "</li>"; 
    } 
    echo "</ul>";
     echo '<p><a href="index_tienda.html">Volver a la tienda</a></p>';
     } else {
        // Mensaje si el carrito está vacío 
        echo "<h1>El carrito está vacío</h1>"; 
        echo '<p><a href="index_tienda.html">Volver a la tienda</a></p>'; 
    } ?>