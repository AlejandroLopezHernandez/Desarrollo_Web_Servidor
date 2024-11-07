<?php
class VistaTablero
{
    public function __construct() {}
    public function mostrarTablero($pos, $meta, $score)
    {
        // Mostrar el tablero de 10x10 y los controles de movimiento
        echo "<h2>Juego: Mueve el personaje para llegar a la
salida</h2>";
        echo "<h3>Puntuación: {$score}</h3>";
        echo "<table border='1' cellpadding='10'>";
        for ($i = 0; $i < 10; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 10; $j++) {
                $position = $pos; // Posición del personaje
                $exit = $meta; // Posición de la salida, suponiendo que está definida en la sesión
                if ($i == $position['row'] && $j == $position['col']) {
                    // Mostrar el personaje
                    echo "<td style='background-color: green; color:white;'>P</td>";
                } elseif ($i == $exit['row'] && $j == $exit['col']) {
                    // Mostrar la salida
                    echo "<td style='background-color: yellow; color:black;'>E</td>"; // E para "Exit"
                } else {
                    echo "<td></td>"; // Casilla vacía
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        // Controles de movimiento
        echo "<div>";
        echo "<a href='controlador_juego.php?move=up'>Arriba</a> | ";
        echo "<a href='controlador_juego.php?move=down'>Abajo</a> | ";
        echo "<a href='controlador_juego.php?move=left'>Izquierda</a> |";
        echo "<a href='controlador_juego.php?move=right'>Derecha</a>";
        echo "</br>";
        echo "<a href='controlador_juego.php?move=exit'>Salir</a>";
        echo "</div>";
        echo "</br>";
        echo "<a href='controlador_juego.php?action=ver_partidas'>Ver partidas guardadas</a>";
    }
}
