<?php
require_once '../clases/RepositorioMYSQL.php';
require_once '../clases/VistaHTML.php';
$vista = new VistaHTML();
$repositorio = new RepositorioMYSQL("mysql", "root", "1234", "emergencia");
$municipios=$repositorio->obtenerMunicipiosConMasAfectados();
$total_afectados=$repositorio->obtenerNumeroTotalfectados();
$vista->mostrarEstadoMunicipios($municipios,$total_afectados);

