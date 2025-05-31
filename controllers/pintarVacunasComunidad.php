<?php
// Incluir el archivo que contiene la clase BBDD para acceder a la base de datos
require_once __DIR__ . '/../models/BBDD.php';

// Crear una instancia de la clase BBDD que manejará la conexión con la base de datos
$bbdd = new BBDD();

$comunidades = $bbdd->obtenerComunidades();



