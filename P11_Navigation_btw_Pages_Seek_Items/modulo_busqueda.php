<?php 
include 'modulo_datos.php'; 
    if (isset($_GET['busqueda'])) { 

        $busqueda = strtolower($_GET['busqueda']); 
        echo "<h2>Resultados de búsqueda:</h2>"; 
        echo "<ul>"; 
        /*La función strpos devuelve la posición de la primera aparición de una
        subcadena, empezando desde 0, si no la encuentra, da false. Nota: es case sensitive*/
        foreach ($productos as $id => $producto) { 
            if (strpos(strtolower($_GET['busqueda']), $busqueda) !== 
false || strpos(strtolower($_GET['busqueda']), $busqueda) !== false) { 
        echo "<li><a href='detalles.php?producto=$id'> 
        Ver detalles {$producto['nombre']} - {$producto['categoria']} 
        </a></li>"; 
            } 
        } 
        echo "</ul>"; 
        //CUIDADO con las tildes
    }