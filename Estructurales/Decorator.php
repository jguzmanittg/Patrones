<?php

// Interfaz Bebida
interface Bebida {
    public function descripcion(): string;
    public function costo(): float;
}

// Clase Café: una bebida concreta
class Cafe implements Bebida {
    public function descripcion(): string {
        return "Liquido que unos lo toman caliente otros frio.";
    }

    public function costo(): float {
        return 1;
    }
}

// Decorador abstracto para Bebida
abstract class BebidaDecorator implements Bebida {
    protected Bebida $bebida;

    public function __construct(Bebida $bebida) {
        $this->bebida = $bebida;
    }

    abstract public function descripcion(): string;
    abstract public function costo(): float;
}

// Decorador Leche que agrega leche a la bebida
class LecheDecorator extends BebidaDecorator {
    public function descripcion(): string {
        return $this->bebida->descripcion() . ",  le ponen leche Leche";
    }

    public function costo(): float {
        return $this->bebida->costo() + 0.50;
    }
}

// Decorador Azúcar que agrega azúcar a la bebida
class AzucarDecorator extends BebidaDecorator {
    public function descripcion(): string {
        return $this->bebida->descripcion() . ",  unos con azúcar";
    }

    public function costo(): float {
        return $this->bebida->costo() + 0.25;
    }
}

// Probar el patrón Decorator
$bebida = new Cafe();
echo $bebida->descripcion() . "\n";
echo "Costo: " . $bebida->costo() . "\n";

/*
$bebida = new LecheDecorator($bebida);
echo $bebida->descripcion() . "\n";
echo "Costo: " . $bebida->costo() . "\n";
*/

$bebida = new AzucarDecorator($bebida);
echo $bebida->descripcion() . "\n";
echo "Costo: " . $bebida->costo() . "\n";

?>
