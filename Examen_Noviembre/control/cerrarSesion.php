<?php
session_start();
    session_destroy();

    echo "Sesión finalizada";
    
    header('Location:../index.html');
    exit();
