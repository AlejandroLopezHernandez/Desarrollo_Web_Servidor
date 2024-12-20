<?php
// Configuración de conexión con la base de datos
require_once '../clases/RepositoryMySQL.php';
require_once '../clases/VistaHTML.php';

$host = 'mysql';
$dbname = 'FLOTA';
$username = 'root';
$password = '1234';

$repository = new RepositoryMySQL($host, $dbname, $username, $password);
$vista =  new VistaHTML();
// Verificar si hay sesión activa, sino
session_start();

if (!isset($_SESSION['usuario_admin'])) {
    header('Location: autenticar.php');
    exit;
}

// Verificar si se ha subido un archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo'])) {
    $archivo = $_FILES['archivo']['tmp_name'];


    // Obtendo el
    $contenido = file_get_contents($archivo);
    $datos = json_decode($contenido, true);
    $ruta_archivo_local = "../uploads/";
    // Extraer datos (Se omite comprobación de validez del archivo)

    $vehiculos = $datos['vehiculos'];
    $conductores = $datos['conductores'];

    copiarArchivo($archivo, $ruta_archivo_local);
    // Procesar conductores
    foreach ($conductores as $conductor) {
        $id = $conductor['id'];
        $nombre = $conductor['nombre'];
        $telefono = $conductor['telefono'];

        $repository->insertarConductor($id, $nombre, $telefono);
    }

    // Procesar vehículos
    $contador_vehiculos = 0; // El numero de vehiculos no lo sabemos hasta que no los comprobemos
    foreach ($vehiculos as $vehiculo) {
        $id_conductor = $vehiculo['id'];
        $matricula = $vehiculo['matricula'];
        $tipo = $vehiculo['tipo'];
        $coordenada_x = 0; // Valor por defecto
        $coordenada_y = 0; // Valor por defecto
        $alarma = 0;       // Valor por defecto
        if (strlen($matricula) == 8 && ($tipo == "camion" || $tipo == "furgoneta")) {
                $repository->insertarVehiculo($id_conductor, $matricula, $tipo, $coordenada_x, $coordenada_y, $alarma);
                $contador_vehiculos++;
            }
    }


    // Obtener el ID del administrador
    $idAdmin = $_SESSION['usuario_admin']; // Asumimos que el ID del administrador está en la sesión

    // Registrar en la tabla LOGS
    $fechaSubida = "";
    $numVehiculos = $contador_vehiculos;
    $numConductores = count($conductores);
    $repository->registrarLog($idAdmin, $fechaSubida, $numVehiculos, $numConductores);
    $vista->mostrarMensaje("Archivo subido y registrado");
} else {

    $vista->mostrarMensaje( "Error : Nos se ha recibido un arcchivo JSON");
}

function copiarArchivo($origen, $destino)
{

    $dia = date('d');
    $mes = date('m');
    $destino = $destino . $dia . '_' . $mes . 'nuevaflota.json';
    if (move_uploaded_file($origen, $destino)) { // Copiar el archivo
        echo "El archivo ha sido subido con éxito";
    } else {
        echo "Error al subir el archivo.";
    }
}
