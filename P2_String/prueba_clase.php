<?php
//Escribimos require once más el nombre del archivo con extensión PHP, con comillas
require_once 'analizador_discurso.php';
//Creamos un objeto,que es a su vez una variable, en new debemos escribir el nombre de la clase
$analizador = new AnalizadorDiscurso();
//añadimos el método __construct()
$analizador->__construct();
$texto ="La libertad, Sancho, es uno de los más preciosos dones que a los hombres dieron los cielos;
    con ella no pueden igualarse los tesoros que encierra la tierra ni el mar encubre; por la libertad,
    así como por la honra, se puede y debe aventurar la vida, y, por el contrario, el cautiverio es el mayor mal
    que puede venir a los hombres.";
//Usamos los métodos para hacer el constructor y agregar el discurso
$analizador->agregar_discurso($texto);
//con la flecha -> podemos ver los métodos de esa clase
$analizador->analizar();