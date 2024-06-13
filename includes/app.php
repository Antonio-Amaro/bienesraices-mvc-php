<?php

use Dotenv\Dotenv;
use Model\ActiveRecord;
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    require 'funciones.php';
    require 'config/database.php';

    // Crea una nueva instancia con la conexión a la BD
    $db = conectarDB();

    // Pasamos la conexión de la BD al método para crear el atributo
    // Se usa aquí el método para que todas las instancias ya cuenten con una referencia/conexión
    // y porque aquí está el "require" a la BD
    ActiveRecord::setDB($db);