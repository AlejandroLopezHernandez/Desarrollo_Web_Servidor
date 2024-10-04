<?php
echo "Método de solicitud: " . $_SERVER['REQUEST_METHOD'] .
    "<br>";
echo "Agente de usuario: " . $_SERVER['HTTP_USER_AGENT'] .
    "<br>";
echo "Dirección IP del cliente: " . $_SERVER['REMOTE_ADDR'] .
    "<br>";
