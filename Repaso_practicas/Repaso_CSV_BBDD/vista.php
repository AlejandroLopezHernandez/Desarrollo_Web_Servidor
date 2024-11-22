<?php
class Vista_inmigracion{
    public function __construct(){}

    public function MostrarDatos($datos){
        echo ' 
        <!DOCTYPE html> 
        <html lang="es"> 
        <head> 
            <meta charset="UTF-8"> 
            <title>Datos de inmigración en Cataluña</title> 
        </head> 
        <body> 
            <h2>Datos de inmigración en Cataluña</h2> 
            <table border="1"> 
                <thead> 
                    <tr> 
                        <th>Año</th> 
                        <th>Código de país</th> 
                        <th>Nacionalidad</th>
                        <th>Poblacion</th> 
                    </tr> 
                </thead> 
                <tbody>';
            foreach($datos as $dato){
                echo "<tr> 
                    <td>{$dato['Any']}</td> 
                    <td>{$dato['Codi_Pays']}</td>                              
                     <td>{$dato['Nacionalitat']}</td> 
                     <td>{$dato['Poblaci']}</td> 
                  </tr>";
            }
            echo ' 
            </tbody> 
            </table> 
            </body>';
    }
}