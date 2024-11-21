<?php
require_once 'repositorioSQL.php';
require_once 'Vista.php';
try{
    $vista = new Vista_Transporte();
    $repositorio = new Repostorio_MySQL_Transporte(
        "mysql",
        "Transporte",
        "root",
        "1234"
    );
    if(isset($_GET['action']) && $_GET['action'] == 1){
        $barcos = $repositorio->buscarBarcoPorNombre($_GET['buscar_barco']);
        var_dump($barcos); //Sirve para imprimir sólo el contenido de una variable
        if(!empty($barcos)){
          $vista->MostrarBarco($barcos);
        } else {
            echo "<p>No se encontraron barcos con ese nombre</p>";
        }
    }else if(isset($_GET['action']) && $_GET['action'] == 2){
        
        $aviones = $repositorio->buscarAvionPorNombre($_GET['buscar_avion']);
        if(!empty($aviones)){
            $vista->MostrarAvion($aviones);
        }
    }else if(isset($_GET['action']) && $_GET['action'] == 3){
        
        $todos_barcos = $repositorio->MostrarBarcos();
        if(!empty($todos_barcos)){
            $vista->MostrarTodosBarcos($todos_barcos);
        } 
    }
    else if(isset($_GET['action']) && $_GET['action'] == 4){
        
        $todos_aviones = $repositorio->MostrarAviones();
        if(!empty($todos_aviones)){
            $vista->MostrarTodosAviones($todos_aviones);
        } 
    }
} catch(PDOException $excepcion){
    echo "Error de conexión".$excepcion->getMessage();
}