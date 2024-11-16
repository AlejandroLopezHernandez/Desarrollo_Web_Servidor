<?php
require_once 'Movimiento.php';

session_start();


if (isset($_GET['move'])) {
    // 1.- Obtener la posición actual y procesar el movimiento para actualizar posición
    $position = &$_SESSION['position']; // OJO FIJATE COMO SE USA &
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
            header('Location: index.php');
    }

    // 2.- Guardar la trayectoria del movimiento
    //$_SESSION['moves'][] = ["row" => $position['row'], "col" => $position['col']];
    $_SESSION['moves'][] = new Movimiento($position['row'], $position['col']);
    
    // 3.- Verificar si cayó en una trampa
    $isTrap = false;
    foreach ($_SESSION['traps'] as $trap) {
        if ($trap['row'] == $position['row'] && $trap['col'] == $position['col']) {
            $_SESSION['score'] -= 10; // Restar puntos
            $isTrap = true;
            break;
        }
    }

    // 4.- Verificar si ha llegado a la salida
    $isExit = ($position['row'] == $_SESSION['exit']['row'] && $position['col'] == $_SESSION['exit']['col']);

    // 5.- si el usuario llegó a la salida terminar partida cerrando la sesión
    if ($isExit) {
        echo "<h2>Felicidades! Has llegado a la salida.</h2>";
        echo "<h3>Puntuación final: {$_SESSION['score']}</h3>";
        echo "<h4>Trayectoria recorrida:</h4>";
        //echo "<pre>" . json_encode($_SESSION['moves'], JSON_PRETTY_PRINT) . "</pre>";
        foreach ($_SESSION['moves'] as $movimiento) {
            echo "<pre>" . $movimiento->getFila() . "," . $movimiento->getColumna();
        }

        session_destroy(); // Terminar la sesión y la partida
        exit();
    } else {

        // Si no se ha llegado al final se vuelve a mostrar el tablero a través de index
        // Redirigir a index.php para actualizar el tablero
        header('Location: index.php');
    }
}

