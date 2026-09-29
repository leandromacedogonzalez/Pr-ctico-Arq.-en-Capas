<?php
class Conexion
{
    public static function obtener(): PDO
    {
        $config = require __DIR__ . "/../config/config.php";

        $host = $config["host"];
        $db   = $config["db"];
        $user = $config["user"];
        $pass = $config["pass"];
        
        $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        return $conexion;
    }
}
