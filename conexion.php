<?php

// iniciamos una sesion para guardar mensajes y mostrarselos solo a ese usuario
session_start();

$db = new mysqli('localhost', 'root', '', 'empresa');
if($db->connect_errno != null){
    echo "Error numero $db->connect_errno conectando a la base de datos.<br>Mensaje: $db->connect_error.";
    exit();
}

?>