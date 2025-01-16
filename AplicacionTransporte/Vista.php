<?php
class Vista_Transporte{
    public function __construct(){}
    public function MostrarBarco($barco){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre el barco</title> 
    </head> 
    <body> 
        <h2>Información sobre el barco: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Barco ID</th> 
                    <th>Longitud</th> 
                    <th>Tipo de propulsión</th> 
                    <th>Calado</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($barco as $b){
            echo "<tr> 
                <td>{$b['identificador']}</td> 
                <td>{$b['longitud']}</td> 
                <td>{$b['tipo_propulsion']}</td>                              
                 <td>{$b['calado_maximo']}</td> 
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function MostrarAvion($avion){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre el avion</title> 
    </head> 
    <body> 
        <h2>Información sobre el avion: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Avion ID</th> 
                    <th>Altura máxima</th> 
                    <th>Velocidad máxima</th> 
                    <th>Tipo de ala</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($avion as $a){
            echo "<tr> 
                <td>{$a['identificador']}</td> 
                <td>{$a['altura_maxima']}</td> 
                <td>{$a['velocidad_maxima']}</td>                              
                 <td>{$a['tipo_ala']}</td> 
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function MostrarTodosBarcos($barco){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre los barcos</title> 
    </head> 
    <body> 
        <h2>Información sobre los barcos: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Nombre</th>
                    <th>Barco ID</th> 
                    <th>Longitud</th> 
                    <th>Tipo de propulsión</th> 
                    <th>Calado</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($barco as $b){
            echo "<tr> 
                <td>{$b['nombre']}</td> 
                <td>{$b['identificador']}</td> 
                <td>{$b['longitud']}</td> 
                <td>{$b['tipo_propulsion']}</td>                              
                <td>{$b['calado_maximo']}</td> 
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function MostrarTodosAviones($avion){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre los aviones</title> 
    </head> 
    <body> 
        <h2>Información sobre los aviones</h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Nombre</th>
                    <th>Avion ID</th> 
                    <th>Altura máxima</th> 
                    <th>Velocidad máxima</th> 
                    <th>Tipo de ala</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($avion as $a){
            echo "<tr> 
                <td>{$a['nombre']}</td> 
                <td>{$a['identificador']}</td> 
                <td>{$a['altura_maxima']}</td> 
                <td>{$a['velocidad_maxima']}</td>                              
                 <td>{$a['tipo_ala']}</td> 
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function MostrarCamiones($camion){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre camiones</title> 
    </head> 
    <body> 
        <h2>Información sobre los camiones: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Camion ID</th> 
                    <th>Nomnbre</th> 
                    <th>Tipo de cabina</th> 
                    <th>Capacidad de carga</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($camion as $c){
            echo "<tr> 
                <td>{$c['id']}</td> 
                <td>{$c['nombre']}</td> 
                <td>{$c['tipo de cabina']}</td>                              
                 <td>{$c['capacidad de carga']}</td> 
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function n_aviones($avion){
        echo "<strong>Número de aviones:</strong>{$avion['n_aviones']} <br>";
    }
    public function n_barcos($barco){
        echo "<strong>Número de barcos:</strong>{$barco['n_barcos']} <br>";
    }public function n_vehiculos($vehiculo){
        echo "<strong>Número de vehículos:</strong>{$vehiculo['n_vehiculos']} <br>";
    }
    public function Mostrar_detalles_camion($camion){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre el camión</title> 
    </head> 
    <body> 
        <h2>Información sobre el camión: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Nombre</th> 
                    <th>Longitud</th> 
                    <th>Tipo de cabina</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($camion as $c){
            echo "<tr> 
                <td>{$c['nombre']}</td> 
                <td>{$c['longitud']}</td> 
                <td>{$c['tipo de cabina']}</td>                              
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function conductoresYcamiones($datos){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre el conductor y su camión</title> 
    </head> 
    <body> 
        <h2>Información sobre el conductor y su camión: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Nombre del camión</th> 
                    <th>Nombre del conductor</th> 
                    <th>Teléfono</th> 
                    <th>Dirección</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($datos as $d){
            echo "<tr> 
                <td>{$d['nombre camion']}</td> 
                <td>{$d['nombre conductor']}</td> 
                <td>{$d['telefono']}</td>  
                <td>{$d['direccion']}</td>                              
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    public function Mostar_Rutas_Camion($rutas){
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Información sobre el camión y sus rutas:</title> 
    </head> 
    <body> 
        <h2>Información sobre el camión y sus rutas: </h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                <th>ID del camión</th> 
                <th>Nombre del camión</th> 
                <th>Origen</th> 
                <th>Destino</th> 
                <th>Distancia en KM</th> 
                <th>Fecha</th> 
                <th>Costo</th> 
                </tr> 
            </thead> 
            <tbody>';
        foreach($rutas as $r){
            echo "<tr> 
                <td>{$r['camion_id']}</td> 
                <td>{$r['nombre']}</td> 
                <td>{$r['origen']}</td>  
                <td>{$r['destino']}</td>                              
                <td>{$r['distancia_km']}</td>                              
                <td>{$r['fecha']}</td>  
                <td>{$r['costo']}</td>                              
              </tr>";
        }
        echo ' 
        </tbody> 
        </table> 
        </body>';
    }
    }
