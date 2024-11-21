<?php
require_once 'repositorio.php';
$repositorio = new repositorio_juego('mysql','game_matrix','root','1234');
$partidas = $repositorio->SacarPuntuacion();
var_dump($repositorio);
foreach($partidas as $puntuacion){
    echo "Puntuación:".$puntuacion['score'];
}