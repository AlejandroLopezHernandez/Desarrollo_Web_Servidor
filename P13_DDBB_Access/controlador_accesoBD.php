<?php
require_once 'vendor/autoload.php';
require_once 'Clases/RepositoryMySQL.php';
try {
    // Crear una instancia del repositorio
    $repository = new RPGRepositoryMySQL(

        $servername = "mysql",
        $dbname = "rpg_game",
        $username = "root",
        $password = "1234"

    );
    /*Hay que filtrar con if y else lo que llega del HTML */
    if (isset($_GET['action']) && $_GET['action'] == 1) {
        echo " <h1>Información del juego : LISTA DE PERSONAJES Y LISTA DE DESAFIOS:</h1>";
        /*Mostrar todos los personajes
        Por lo visto, hay que declarar una variable de personajes,
        después llamamos al repositorio de MySQL, y después a la función para encontrar los personajes*/
        $characters = $repository->findAllCharacters();
        echo " <h3>Lista de personajes del juego: </h3>";
        foreach ($characters as $character) {
            echo $character['id'];
            echo $character['name'];

            echo "------\n";
            // Separador entre personajes
        }
        /*Mostrar todas las quests/desafios
        Como la vez anterior, hay que llamar a la función del repositorio de MySQL*/
        $quests = $repository->findAllQuests();
        foreach ($quests as $quest) {
            echo $quest['title'];
            echo $quest['is_completed'];

            echo "------\n";
        }
    } else if (isset($_GET['action']) && $_GET['action'] == 2) {
        //Mostrar sólo un personaje y sus misiones
        $quests = $repository->findQuestsByCharacterName($_GET['characterName']);
        foreach ($quests as $quest) {
            echo $quest['title'];
            echo "------\n";
        }
    } else if (isset($_GET['action']) && $_GET['action'] == 3) {
        $repository->addCharacter($_GET['name'], $_GET['level'], $_GET['experience'], $_GET['health']);
        echo "Personaje insertado con éxito";
        echo "------\n";
    }
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
