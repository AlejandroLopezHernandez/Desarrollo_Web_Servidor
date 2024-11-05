<?php
require_once 'vendor/autoload.php';
require_once 'Clases/RepositoryMySQL.php';
require_once 'VistaHTML.php';

try {
    // Crear una instancia del repositorio
    $repository = new RPGRepositoryMySQL(

        $servername = "mysql",
        $dbname = "rpg_game",
        $username = "root",
        $password = "1234"

    );
    //Creamos el objeto vista
    $vista = new VistaHTML();
    /*Hay que filtrar con if y else lo que llega del HTML */
    if (isset($_GET['action']) && $_GET['action'] == 1) {
        echo " <h1>Información del juego : LISTA DE PERSONAJES Y LISTA DE DESAFIOS:</h1>";
        /*Mostrar todos los personajes
        Por lo visto, hay que declarar una variable de personajes,
        después llamamos al repositorio de MySQL, y después a la función para encontrar los personajes*/
        $characters = $repository->findAllCharacters();
        $vista->showCharacters($characters);

        /*Mostrar todas las quests/desafios
        Como la vez anterior, hay que llamar a la función del repositorio de MySQL*/
        $quests = $repository->findAllQuests();
        $vista->showQuests($quests);
        $vista->mostrarInformacionJuego($characters, $quests);
    } else if (isset($_GET['action']) && $_GET['action'] == 2) {
        //Mostrar sólo un personaje y sus misiones
        $quests = $repository->findQuestsByCharacterName($_GET['characterName']);
        $vista->showQuestsOfCharacter($_GET['characterName'], $quests);
    } else if (isset($_GET['action']) && $_GET['action'] == 3) {
        $repository->addCharacter($_GET['name'], $_GET['level'], $_GET['experience'], $_GET['health']);
        $mensaje = "Personaje insertado con éxito";
        $vista->mostrarMensaje($mensaje);
    }
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}
