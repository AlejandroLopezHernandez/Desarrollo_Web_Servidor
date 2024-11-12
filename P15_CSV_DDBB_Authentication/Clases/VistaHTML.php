<?php
class VistaHTML
{
    //No hay que añadir nada más
    public function __construct() {}

    public function mostrarEstadoMunicipios($municipios, $total)
    {
        echo ' 
    <!DOCTYPE html> 
    <html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <title>Consulta de Ayuda - Protección Civil</title> 
    </head> 
    <body> 
        <h2>Necesidades de Ayuda - Municipios Afectados</h2> 
        <table border="1"> 
            <thead> 
                <tr> 
                    <th>Nombre Población</th> 
                    <th>Personas Afectadas</th> 
                    <th>Comunicaciones Cortadas</th> 
                    <th>personas_afectadas </th> 
                    <th>agua</th> 
                    <th>productos_limpieza</th> 
                    <th>viveres</th> 
                    <th>medicinas</th> 
                   <th>otros</th> 
                    <th>Fecha de Reporte</th> 
                </tr> 
            </thead> 
            <tbody>';


        foreach ($municipios as $registro) {
            echo "<tr> 
                            <td>{$registro['nombre_poblacion']}<td> 
                            <td>{$registro['personas_afectadas']}</td> 
                            <td>{$registro['comunicaciones_cortadas']}</td>                             
                            <td>{$registro['personas_afectadas']}</td>  
                             <td>{$registro['agua']}</td> 
                            <td>{$registro['productos_limpieza']}</td> 
                            <td>{$registro['viveres']}</td> 
                            <td>{$registro['medicinas']}</td>
                            <td>{$registro['otros']}</td> 
                            <td>{$registro['fecha_reporte']}</td> 
                          </tr>";
        }
        echo ' 
            </tbody> 
            </table> 
            </body>';
        echo '<h1> Total afectados ' . $total . '</h1>';
        echo '</html>';
    }
}
