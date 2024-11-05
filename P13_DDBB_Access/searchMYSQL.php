<?php
$servername = "mysql";  // Nombre del servicio definido en docker-compose.yml
$username = "root";      // Nombre de usuario
$password = "1234";      // Contraseña
$dbname = "rpg_game";    // Nombre de la base de datos

try {
    // Crear conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Nombre del personaje a buscar
    $characterName = 'Ulises';

    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("
        SELECT q.title, q.description, q.reward, q.is_completed
        FROM quests q
        JOIN character_quests cq ON q.id = cq.quest_id
        JOIN characters c ON cq.character_id = c.id
        WHERE c.name = :characterName
    ");
    $stmt->bindParam(':characterName', $characterName);
    $stmt->execute();

    // Obtener los resultados
    $missions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar el nombre del personaje
    echo "<h1>Misiones de $characterName</h1>";

    // Comprobar si hay misiones
    if (count($missions) > 0) {
        echo "<ul>";
        foreach ($missions as $mission) {
            echo "<li>";
            echo "<strong>Título:</strong> " . htmlspecialchars($mission['title']) . "<br>";
            echo "<strong>Descripción:</strong> " . htmlspecialchars($mission['description']) . "<br>";
            echo "<strong>Recompensa:</strong> " . htmlspecialchars($mission['reward']) . "<br>";
            echo "<strong>Completada:</strong> " . ($mission['is_completed'] ? 'Sí' : 'No') . "<br>";
            echo "</li><br>";
        }
        echo "</ul>";
    } else {
        echo "No hay misiones asignadas a este personaje.";
    }

    // Cerrar la conexión
    $conn = null; 
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

