<?php
/*
    public static void main
*/

class Single {
    private static ?Single $instance = null;
    private $time_stamp;

    // Constructor privado para evitar instanciación externa
    private function __construct() {
        $this->time_stamp = time() * 1000; // Timestamp en milisegundos
    }

    // Método para obtener la instancia única de la clase
    public static function getInstance(): Single {
        if (self::$instance === null) {
            self::$instance = new Single();
        }
        return self::$instance;
    }

    // Método para mostrar el mensaje con el timestamp de creación
    public function mostrarMensaje(): void {
        echo "¡Hola Timestamp de creación: " . date("Y-m-d H:i:s", $this->time_stamp / 1000) . "\n";
    }
}

// Uso del patrón Singleton
$singleton = Single::getInstance();
$singleton->mostrarMensaje();
