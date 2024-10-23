<?php
require 'vendor/autoload.php'; // Asegúrate de tener el autoload de Composer

$servername = "mongodb://mongo:27017"; // Nombre del servicio MongoDB en docker-compose
$dbname = "rpg_game"; // Nombre de la base de datos
$characterName = "Ulises"; // Nombre del personaje a buscar

try {
    // Crear conexión a MongoDB
    $client = new MongoDB\Client($servername);
    
    // Seleccionar la base de datos y la colección
    $db = $client->$dbname;
    $charactersCollection = $db->characters;

    // Buscar el personaje por nombre
    $character = $charactersCollection->findOne(['name' => $characterName]);

    if ($character) {
        echo "Misiones de " . $characterName . ":\n";
        foreach ($character['quests'] as $quest) {
            echo "- " . $quest['title'] . (isset($quest['is_completed']) && $quest['is_completed'] ? " (Completada)" : " (No completada)") . "\n";
        }
    } else {
        echo "Personaje no encontrado.";
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error de conexión: " . $e->getMessage();
}
