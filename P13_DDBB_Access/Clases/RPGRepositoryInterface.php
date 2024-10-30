<?php
//Interfaz abstracta
interface RPGRepositoryInterface
{
    public function __construct(
        $servername,
        $dbname,
        $username,
        $password
    );
    // Método para encontrar una quest por su nombre
    public function findQuestByName(string $name);
    // Método para obtener todas las quests
    public function findAllQuests();
    // Método para obtener todos los personajes
    public function findAllCharacters();
    // Método para obtener las quests asociadas a un personaje por su ID
    public function findQuestsByCharacterName(string $name);
    // Método para encontrar un personaje por su nombre
    public function findCharacterByName(string $name);
    //Método para encontrar la misión de un personaje
    /*public function findQuestOfCharacter(string $name);*/
    //Método para insertar personaje
    public function addCharacter(string $name, int $level, int $experience, int $health);
}
