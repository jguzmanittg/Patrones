<?php

// Interfaz Componente
interface Componente {
    public function mostrar(): void;
}

// Clase Hoja: representa un archivo individual
class Archivo implements Componente {
    private string $nombre;
    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }
    public function mostrar(): void {
        echo "Archivo: " . $this->nombre . "\n";
    }
}

// Clase Compuesta: representa una carpeta que puede contener archivos y otras carpetas
class Carpeta implements Componente {
    private string $nombre;
    private array $componentes = [];

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function agregar(Componente $componente): void {
        $this->componentes[] = $componente;
    }

    public function eliminar(Componente $componente): void {
        $this->componentes = array_filter($this->componentes, function($item) use ($componente) {
            return $item !== $componente;
        });
    }

    public function mostrar(): void {
        echo "Carpeta: " . $this->nombre . "\n";
        foreach ($this->componentes as $componente) {
            $componente->mostrar();
        }
    }
}

// Probar el patrón Composite
$archivo1 = new Archivo("documento.txt");
$archivo2 = new Archivo("imagen.jpg");
$archivo3 = new Archivo("video.mp4");

$carpeta1 = new Carpeta("Carpeta Personal");
$carpeta2 = new Carpeta("Carpeta de Trabajo");

$carpeta1->agregar($archivo1);
$carpeta1->agregar($archivo2);
$carpeta2->agregar($archivo3);

$carpetaRaiz = new Carpeta("Raiz");
$carpetaRaiz->agregar($carpeta1);
$carpetaRaiz->agregar($carpeta2);

// Mostrando la estructura del sistema de archivos
$carpetaRaiz->mostrar();
//$archivo2->mostrar();