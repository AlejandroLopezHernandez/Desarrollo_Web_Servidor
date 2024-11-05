<?php
require_once 'movimiento.php';
require_once 'repositoriobbdd.php';

session_start();
// Si se ha mandado un movimiento
if (isset($_GET['move'])) {
    // 1.- Obtener la posición actual y procesar el movimiento para actualizar posición
    $position = &$_SESSION['position']; // OJO fíjate en el operador &
    $move = $_GET['move'];
    switch ($move) {
        case 'up':
            if ($position['row'] > 0) $position['row']--;
            break;
        case 'down':
            if ($position['row'] < 9) $position['row']++;
            break;
        case 'left':
            if ($position['col'] > 0) $position['col']--;
            break;
        case 'right':
            if ($position['col'] < 9) $position['col']++;
            break;
        case 'exit':
            session_destroy();
            header('Location: indice_juego.php');
    }
    // 2.- Guardar la trayectoria del movimiento
    $_SESSION['moves'][] = ["row" => $position['row'], "col" =>
    $position['col']];
    $_SESSION['moves'][] = new Movimiento(
        $position['row'],
        $position['col']
    );
    // 3.- Verificar si cayó en una trampa
    $isTrap = false;
    foreach ($_SESSION['traps'] as $trap) {
        if (
            $trap['row'] == $position['row'] && $trap['col'] ==
            $position['col']
        ) {
            $_SESSION['score'] -= 10; // Restar puntos
            $isTrap = true;
            break;
        }
    }
    // 4.- Verificar si ha llegado a la salida
    $isExit = ($position['row'] == $_SESSION['exit']['row'] &&
        $position['col'] == $_SESSION['exit']['col']);
    // 5.- si el usuario llegó a la salida terminar partida cerrando la sesión
    if ($isExit) {
        echo "<h2>Felicidades! Has llegado a la salida.</h2>";
        echo "<h3>Puntuación final: {$_SESSION['score']}</h3>";
        echo "<h4>Trayectoria recorrida:</h4>";
        echo "<pre>" . json_encode($_SESSION['moves'], JSON_PRETTY_PRINT) .
            "</pre>";
        foreach ($_SESSION['moves'] as $movimiento) {
            echo "<pre>" . $movimiento->getFila() . "," . $movimiento->getColumna();
        }
        session_destroy(); // Terminar la sesión y la partida
        exit();
    } else {
        // Si no se ha llegado al final se vuelve a mostrar el tablero a través de index
        // Redirigir a indice_juego.php para actualizar el tablero
        header('Location: indice_juego.php');
    }
}

try {
    $repositorio = new Repositorio_BBDD(
        $servername = "mysql",
        $dbname = "rpg_game",
        $username = "root",
        $password = '1234'
    );

    $repositorio->sacar_todos_datos();
} catch (PDOException $e) {
    echo "Error de conexión con la base de datos" . $e->getMessage();
}
