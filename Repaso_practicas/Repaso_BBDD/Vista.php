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
}