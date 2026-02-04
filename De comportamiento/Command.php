<?php

// Interfaz Electrodomestico
interface Electrodomestico {
    public function encender(): void;
    public function apagar(): void;
}

// Implementación de diferentes electrodomésticos
class Luz implements Electrodomestico {
    public function encender(): void {
        echo "La luz está encendida\n";
    }

    public function apagar(): void {
        echo "La luz está apagada\n";
    }
}

class Television implements Electrodomestico {
    public function encender(): void {
        echo "La televisión está encendida\n";
    }

    public function apagar(): void {
        echo "La televisión está apagada\n";
    }
}

class DecodificadorSky implements Electrodomestico {
    public function encender(): void {
        echo "El decodificador de Sky está encendido\n";
    }

    public function apagar(): void {
        echo "El decodificador de Sky está apagado\n";
    }
}

// Interfaz Comando
interface Comando {
    public function ejecutar(): void;
}

// Implementación de comandos genéricos para cualquier electrodoméstico
class EncenderComando implements Comando {
    private Electrodomestico $electrodomestico;

    public function __construct(Electrodomestico $electrodomestico) {
        $this->electrodomestico = $electrodomestico;
    }

    public function ejecutar(): void {
        $this->electrodomestico->encender();
    }
}

class ApagarComando implements Comando {
    private Electrodomestico $electrodomestico;

    public function __construct(Electrodomestico $electrodomestico) {
        $this->electrodomestico = $electrodomestico;
    }

    public function ejecutar(): void {
        $this->electrodomestico->apagar();
    }
}

// Clase ControlRemoto con múltiples botones
class ControlRemoto {
    private array $botones = [];

    public function setComando(string $nombreBoton, Comando $comando): void {
        $this->botones[$nombreBoton] = $comando;
    }

    public function presionarBoton(string $nombreBoton): void {
        if (isset($this->botones[$nombreBoton])) {
            $this->botones[$nombreBoton]->ejecutar();
        } else {
            echo "El botón '{$nombreBoton}' no está configurado\n";
        }
    }
}

// ---------------------- PRUEBAS ----------------------

if (count(debug_backtrace()) == 0) {
    // Dispositivos
    $luz = new Luz();
    $tv = new Television();
    $sky = new DecodificadorSky();

    // Comandos
    $encenderLuz = new EncenderComando($luz);
    $apagarLuz = new ApagarComando($luz);

    $encenderTV = new EncenderComando($tv);
    $apagarTV = new ApagarComando($tv);

    $encenderSky = new EncenderComando($sky);
    $apagarSky = new ApagarComando($sky);

    // Control remoto con múltiples botones
    $control = new ControlRemoto();
    $control->setComando("Luz ON", $encenderLuz);
    $control->setComando("Luz OFF", $apagarLuz);
    $control->setComando("TV ON", $encenderTV);
    $control->setComando("TV OFF", $apagarTV);
    $control->setComando("Sky ON", $encenderSky);
    $control->setComando("Sky OFF", $apagarSky);

    // Pruebas
    $control->presionarBoton("Luz ON");  // La luz está encendida
    $control->presionarBoton("TV ON");   // La televisión está encendida
    $control->presionarBoton("Sky ON");  // El decodificador de Sky está encendido

    $control->presionarBoton("Luz OFF"); // La luz está apagada
    $control->presionarBoton("TV OFF");  // La televisión está apagada
    $control->presionarBoton("Sky OFF"); // El decodificador de Sky está apagado

    $control->presionarBoton("Aire Acondicionado"); // El botón 'Aire Acondicionado' no está configurado
}

?>
