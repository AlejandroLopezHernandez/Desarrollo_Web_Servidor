<?

// Conectar a la base de datos utilizando la clase repository
require_once 'RepositoryMSQL.php';

$repositorio = new RepositoryMYSQL('mysql', 'game', 'root', '1234');

$partidas = $repositorio->findAllScores();

foreach ($partidas as $partida) {

    echo $partida['id'];
    echo $partida['score'];
}
