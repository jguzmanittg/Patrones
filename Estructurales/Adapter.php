<?php

// Interfaz para Cargadores
interface Cargador {
    public function cargar();
    public function voltajeOperacional();
}

// Cargador Americano
class CargadorAmericano implements Cargador {
    public function cargar() {
        echo "Cargando dispositivo americano con 120V...\n";
    }
    public function voltajeOperacional() { return 120; }
    public function ajustarVoltaje($voltaje) {
        if ($voltaje > 120) {
            echo "Advertencia: Voltaje demasiado alto para el cargador americano, ajustando a 120V...\n";
            return 120;
        } elseif ($voltaje < 120) {
            echo "Advertencia: Voltaje demasiado bajo para el cargador americano, ajustando a 120V...\n";
            return 120;
        }
        return $voltaje;
    }
}

// Cargador Europeo
class CargadorEuropeo implements Cargador {
    public function cargar() {
        echo "Cargando dispositivo europeo con 230V...\n";
    }
    public function voltajeOperacional() { return 230; }
    public function ajustarVoltaje($voltaje) {
        if ($voltaje > 230) {
            echo "Advertencia: Voltaje demasiado alto para el cargador europeo, ajustando a 230V...\n";
            return 230;
        } elseif ($voltaje < 230) {
            echo "Advertencia: Voltaje demasiado bajo para el cargador europeo, ajustando a 230V...\n";
            return 230;
        }
        return $voltaje;
    }
}

// Enchufe
interface Enchufe {
    public function conectar(Cargador $cargador);
    public function voltajeEntrega();
}

// Enchufe Americano
class EnchufeAmericano implements Enchufe {
    public function conectar(Cargador $cargador) {
        $voltaje = $this->voltajeEntrega();
        $voltajeAjustado = $cargador->ajustarVoltaje($voltaje);
        if ($voltajeAjustado == $voltaje) {
            $cargador->cargar();
        } else {
            echo "El cargador ha sido ajustado al voltaje correcto.\n";
        }
    }
    public function voltajeEntrega() { return 120; }
}

// Enchufe Europeo
class EnchufeEuropeo implements Enchufe {
    public function conectar(Cargador $cargador) {
        $voltaje = $this->voltajeEntrega();
        $voltajeAjustado = $cargador->ajustarVoltaje($voltaje);
        if ($voltajeAjustado == $voltaje) {
            $cargador->cargar();
        } else {
            echo "El cargador ha sido ajustado al voltaje correcto.\n";
        }
    }
    public function voltajeEntrega() { return 230; }
}

// Adaptador de voltaje
class Adaptador implements Cargador {
    private $cargador;
    private $voltajeAdaptado;

    public function __construct(Cargador $cargador, $voltajeObjetivo) {
        $this->cargador = $cargador;
        $this->voltajeAdaptado = $voltajeObjetivo;
    }

    public function cargar() {
        echo "Adaptador: Ajustando voltaje a {$this->voltajeAdaptado}V para el cargador...\n";
        $this->cargador->cargar();
    }

    public function voltajeOperacional() {
        return $this->voltajeAdaptado;
    }

    public function ajustarVoltaje($voltaje) {
        // Si el voltaje es diferente del deseado, lo ajustamos.
        return $this->voltajeAdaptado;
    }
}

if (count(debug_backtrace()) == 0) {
    // ---------------------- PRUEBAS ----------------------

    $enchufeUSA = new EnchufeAmericano();
    $enchufeEU = new EnchufeEuropeo();

    $cargadorUSA = new CargadorAmericano();
    $cargadorEU = new CargadorEuropeo();

    echo "Conectando un cargador americano a un enchufe europeo sin adaptador:\n";
    $enchufeEU->conectar($cargadorUSA); // Debería ajustar el voltaje o dar advertencia
    echo "\nConectando un cargador europeo a un enchufe americano sin adaptador:\n";
    $enchufeUSA->conectar($cargadorEU); // Debería ajustar el voltaje o dar advertencia
    echo "\nConectando cargador americano a enchufe americano:\n";
    $enchufeUSA->conectar($cargadorUSA); // Funcionará sin problemas
    echo "\nUsando un adaptador para conectar un cargador europeo a un enchufe americano:\n";
    $adaptadorEUtoUSA = new Adaptador($cargadorEU, 120);
    $enchufeUSA->conectar($adaptadorEUtoUSA); // Ajusta el voltaje
    echo "\nUsando un adaptador para conectar un cargador americano a un enchufe europeo:\n";
    $adaptadorUSAtoEU = new Adaptador($cargadorUSA, 230);
    $enchufeEU->conectar($adaptadorUSAtoEU); // Ajusta el voltaje
}

?>
