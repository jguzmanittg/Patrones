<?php

// Interfaz Comando
interface Comando {
    public function ejecutar(): void;
}

// Clase LuzEncendidaCommand que implementa Comando
class LuzEncendidaCommand implements Comando {
    private Luz $luz;

    public function __construct(Luz $luz) {
        $this->luz = $luz;
    }

    public function ejecutar(): void {
        $this->luz->encender();
    }
}

// Clase LuzApagadaCommand que implementa Comando
class LuzApagadaCommand implements Comando {
    private Luz $luz;

    public function __construct(Luz $luz) {
        $this->luz = $luz;
    }

    public function ejecutar(): void {
        $this->luz->apagar();
    }
}

// Clase Luz
class Luz {
    public function encender(): void {
        echo "La luz está encendida\n";
    }

    public function apagar(): void {
        echo "La luz está apagada\n";
    }
}

// Clase ControlRemoto
class ControlRemoto {
    private ?Comando $comando = null;

    public function setComando(Comando $comando): void {
        $this->comando = $comando;
    }

    public function presionarBoton(): void {
        if ($this->comando !== null) {
            $this->comando->ejecutar();
        }
    }
}



if (count(debug_backtrace()) == 0) {
    // ---------------------- PRUEBAS ----------------------
// Uso del patrón Command
$luz = new Luz();
$luzEncendida = new LuzEncendidaCommand($luz);
$luzApagada = new LuzApagadaCommand($luz);

$control = new ControlRemoto();
$control->setComando($luzEncendida);
$control->presionarBoton(); // La luz está encendida

$control->setComando($luzApagada);
$control->presionarBoton(); // La luz está apagada


}

?>


