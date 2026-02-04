<?php

// Interfaz Driver
interface Driver {
    public function imprimir();
   
}

// Clase Epson que implementa Driver
class Epson implements Driver {
    public function imprimir() {
        echo "Enviando señal a las tintnas\n";
    }
}

// Clase Hp que implementa Driver
class Hp implements Driver {
    public function imprimir() {
        echo "Imprimiendo, Se pone el tonner, se pasa por el calor para que se fije.\n";
    }
}

// Clase Fabrica para crear vehículos
class Fabrica {
    public static function crearDriver(string $tipo): ?Driver {

        if (!class_exists($tipo)) {
            return null;
        }else{
            return new $tipo();
        }        
    }
}
class Programa{

    public function cargar(Driver $d){

    }
}
// Uso del patrón Factory

$word = new Programa();

$driver = Fabrica::crearDriver("Lexmark");
if ($driver !== null) {
    $driver->imprimir();
} else {
    echo "Tipo de impresora sin driver\n";
}


//$word->cargar($driver);
