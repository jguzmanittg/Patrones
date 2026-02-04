<?php

// Observador
class Observer {
    private string $nombre;

    public function __construct(string $nombre) {
        $this->nombre = $nombre;
    }

    public function notificar(string $mensaje): void {
        echo $this->nombre . " recibió el mensaje: " . $mensaje . "\n";
    }
}

// Recurso
class Recurso {
    private array $observadores = [];
    private string $estado;

    public function agregarObserver(Observer $observador): void {
        $this->observadores[] = $observador;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
        $this->notificarObservers();
    }

    public function notificarObservers(): void {
        foreach ($this->observadores as $observador) {
            $observador->notificar($this->estado);
        }
    }
}

// Uso del patrón Observer

// Creación de observadores
$observador1 = new Observer("Juan");
$observador2 = new Observer("Maria");
$observador3 = new Observer("Pedro");

// Creación del objeto observado
$observado = new Recurso();

// Registrando observadores
$observado->agregarObserver($observador1);
$observado->agregarObserver($observador2);
$observado->agregarObserver($observador3);

// Cambiando el estado del objeto observado, lo que notificará a los observadores
$observado->setEstado("SE CREA UN PEDIDO");

// Salida esperada:
// Juan recibió el mensaje: Nuevo estado actualizado
// Maria recibió el mensaje: Nuevo estado actualizado
