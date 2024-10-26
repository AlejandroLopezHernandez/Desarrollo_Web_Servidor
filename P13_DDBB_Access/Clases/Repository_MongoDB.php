<?php
require 'vendor/autoload.php';
require_once 'RPGRepositoryInterface.php';
class RPGRepositoryMONGODB implements RPGRepositoryInterface
{
    private $client;
    private $db;
    public function __construct(
        $servername,
        $dbname,
        $username,
        $password
    ) {
        // Conectar a la base de datos MongoDB
        $this->client = new
            MongoDB\Client("mongodb://$servername:27017");
        //$this->client = new
        MongoDB\Client("mongodb://$username:$password@$servername/$dbname");
        $this->db = $this->client->selectDatabase($dbname);
    }
    // Método para encontrar una quest por su nombre
    public function findQuestByName(string $name)
    {
        $quest = $this->db->quests->findOne(['title' => $name]);
        return $quest ? $quest : null;
    }
    // Método para obtener todas las quests
    public function findAllQuests()
    {
        $quests = $this->db->quests->find();
        return iterator_to_array($quests);
    } // Método para obtener todos los personajes
    public function findAllCharacters()
    {
        $characters = $this->db->characters->find();
        return iterator_to_array($characters);
    }
    // Método para obtener las quests asociadas a un personaje por su ID
    public function findQuestsByCharacterId(int $characterId)
    {
        $character = $this->db->characters->findOne(['_id'=> 
        new MongoDB\BSON\ObjectId((string)$characterId)]);
        return $character ? $character['quests'] : null;
    }
    // Método para encontrar un personaje por su nombre
    public function findCharacterByName(string $name)
    {
        $character = $this->db->characters->findOne(['name' =>
        $name]);
        return $character ? $character : null;
    }
}
