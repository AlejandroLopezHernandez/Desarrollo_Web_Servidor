<?php 
include 'modulo_datos.php'; 
    if (isset($_GET['busqueda'])) { 

        $busqueda = strtolower($_GET['busqueda']); 
        echo "<h2>Resultados de búsqueda:</h2>"; 
        echo "<ul>"; 
        /*La función strpos devuelve la posición de la primera aparición de una
        subcadena, empezando desde 0, si no la encuentra, da false. Nota: es case sensitive*/
        foreach ($productos as $id => $producto) { 
        /*Hacemos un bucle for each para recorrer los productos que tenemos en nuestra BBDD, y con
        la variable $producto accedemos a los detalles de ese producto. $productos es el nombre de nuestra BBDD.
        Para meternos dentro del array de productos, hay que usar $id para ir por cada
        producto y luego usar $producto para meternos dentro del contenido de cada producto.*/
            if (strpos(strtolower($producto['nombre']), $busqueda) !== false 
            || strpos(strtolower($producto['categoria']), $busqueda) !== false) { 
        echo "<li><a href='detalles.php?producto=$id'> 
        Ver detalles {$producto['nombre']} - {$producto['categoria']} 
        </a></li>"; 
            } 
        } 
        echo "</ul>"; 
        //CUIDADO con las tildes
    }