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
        }else {
            echo "<p>No se encontraron aviones con ese nombre</p>";
        }
    }else if(isset($_GET['action']) && $_GET['action'] == 3){
        $camion = $repositorio->Buscar_camion_x_nombre($_GET['buscar_camion']);
        if(!empty($camion)){
            $vista->Mostrar_detalles_camion($camion);
        } else {
            echo "<p>No se encontraron conductores con ese nombre</p>";
        }  
    }
    else if(isset($_GET['action']) && $_GET['action'] == 4){
        $todos_barcos = $repositorio->MostrarBarcos();
        if(!empty($todos_barcos)){
            $vista->MostrarTodosBarcos($todos_barcos);
        }   
    } else if(isset($_GET['action']) && $_GET['action'] == 5){
        $todos_aviones = $repositorio->MostrarAviones();
        if(!empty($todos_aviones)){
            $vista->MostrarTodosAviones($todos_aviones);
        } 
    } else if(isset($_GET['action']) && $_GET['action'] == 6){
        $todos_camiones = $repositorio->MostrarCamiones();
        if(!empty($todos_camiones)){
            $vista->MostrarCamiones($todos_camiones);
        }      
    } else if(isset($_GET['action']) && $_GET['action'] == 7){    
    $datos_conductores_camiones = $repositorio->conductores_camiones();
    if(!empty($datos_conductores_camiones)){
     $vista->conductoresYcamiones($datos_conductores_camiones);
    }
}else if(isset($_GET['action']) && $_GET['action'] == 8){
   $rutas = $repositorio->buscar_rutas_de_camion($_GET['buscar_ruta']);
   if(!empty($rutas)){
       $vista->Mostar_Rutas_Camion($rutas);
   } else {
       echo "<p>No se encontraron rutas con ese ID</p>";
   }
}

}catch(PDOException $excepcion){
    echo "Error de conexión".$excepcion->getMessage();
}