<?php

// Incluimos las clases necesarias
include_once '../Creacionales/Singleton.php';
include_once '../Creacionales/Factory.php';
include_once '../Creacionales/Builder.php';
include_once '../De comportamiento/Observer.php';
include_once '../De comportamiento/Estrategy.php';
include_once '../Estructurales/Adapter.php'; // Incluir el archivo Adapter.php
include_once '../Estructurales/Composite.php'; // Incluir el archivo Composite.php
include_once '../Estructurales/Decorator.php'; // Incluir el archivo Decorator.php

// Definimos la clase Principal con métodos para probar cada patrón
class Principal {

    public function probarSingleton() {
        echo "Creando una sola instancia del Singleton\n";
        $unica = Single::getInstance();
        $unica->mostrarMensaje();
    }

    public function probarFactory() {
        $tipos = ["Epson", "Hp", "Lexmark"];
        $tipo = $tipos[array_rand($tipos)];
        $impresora = Fabrica::crearDriver($tipo);
        if($impresora) $impresora->imprimir();
        else echo "No hay impresora";
    }

    public function probarBuilder() {
        $carro1 = (new CarroBuilder())
                    ->setMarca("Toyota")
                    ->setModelo("Corolla")
                    ->setColor("Rojo")
                    ->setMotor("V6")
                    ->build();

        $carro2 = (new CarroBuilder())
                    ->setMarca("Honda")
                    ->setModelo("Civic")
                    ->setColor("Azul")
                    ->setMotor("V4")
                    ->build();

        echo $carro1 . "\n";
        echo $carro2 . "\n";
    }

    public function probarObserver() {
        $recurso = new Observado();
        $observador1 = new Observer("Observer 1");
        $observador2 = new Observer("Observer 2");

        $recurso->agregarObserver($observador1);
        $recurso->agregarObserver($observador2);

        $recurso->setEstado("Cambio de estado!1");
        $recurso->setEstado("Cambio de estado!2");
    }

    public function probarEstrategy() {
        $procesador = new ProcesadorPago(new PagoBitCoin());
        $procesador->procesarPago(250.00);

        // Cambiando al método de pago con PayPal
        $procesador->setMetodoPago(new PagoPayPal());
        $procesador->procesarPago(150.00);
    }

// Método para probar el patrón Adapter
public function probarAdapter() {
    echo "Probar el patrón Adapter\n";

    // Crear un enchufe americano
    $enchufe = new EnchufeAmericano();

    // Cargadores posibles
    $cargadores = [
        new CargadorAmericano(),
        new CargadorEuropeo()
    ];

    // Elegir un cargador al azar 
    $cargador = $cargadores[array_rand($cargadores)];

    // Verificar si el voltaje del cargador y el enchufe son compatibles
    if ($enchufe->voltajeEntrega()  != $cargador->voltajeOperacional() ) {
        // Usamos el adaptador para conectar el cargador
        echo "Voltajes no coinciden, usando adaptador.\n";
        $enchufe->conectar(new Adaptador($cargador, 120));

    } else {
        echo "Voltajes coinciden, conectando directamente.\n";
        // Si coinciden, conectamos directamente
        $enchufe->conectar($cargador);
    }
}
    // Método para probar el patrón Composite
    public function probarComposite() {
        echo "Probar el patrón Composite\n";

        // Crear algunos archivos
        $archivo1 = new Archivo("documento.txt");
        $archivo2 = new Archivo("imagen.jpg");
        $archivo3 = new Archivo("video.mp4");

        // Crear carpetas y agregar archivos
        $carpeta1 = new Carpeta("Carpeta Personal");
        $carpeta2 = new Carpeta("Carpeta de Trabajo");

        $carpeta1->agregar($archivo1);
        $carpeta1->agregar($archivo2);
        $carpeta2->agregar($archivo3);

        // Crear una carpeta raíz que contiene otras carpetas
        $carpetaRaiz = new Carpeta("Raiz");
        $carpetaRaiz->agregar($carpeta1);
        $carpetaRaiz->agregar($carpeta2);

        // Mostrar la estructura del sistema de archivos
        $carpetaRaiz->mostrar();
    }

    // Método para probar el patrón Decorator
    public function probarDecorator() {
        echo "Probar el patrón Decorator\n";

        // Crear una bebida base
        $bebida = new Cafe();
        // Decorar la bebida con leche y azúcar
        $bebida = new LecheDecorator($bebida);
        $bebida = new AzucarDecorator($bebida);

        // Mostrar la descripción y el costo de la bebida decorada
        echo $bebida->descripcion() . "\n";
        echo "Costo: " . $bebida->costo() . "\n";
    }
}

// Programa principal
$principal = new Principal();

$opcion = null;

while (true) {
    echo "\nElija una opción:\n";
    echo "a) Probar el patrón Creacional Singleton\n";
    echo "b) Probar el patrón Creacional Factory\n";
    echo "c) Probar el patrón Creacional Builder\n";
    echo "d) Probar el patrón De comportamiento Observer\n";
    echo "e) Probar el patrón De comportamiento Estrategy\n";
    echo "f) Probar el patrón Estructural Adapter\n";
    echo "g) Probar el patrón Estructural Composite\n";
    echo "h) Probar el patrón Estructural Decorator\n"; // Nueva opción para Decorator
    echo "z) Salir\n";

    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 'a':
            $principal->probarSingleton();
            break;
        case 'b':
            $principal->probarFactory();
            break;
        case 'c':
            $principal->probarBuilder();
            break;
        case 'd':
            $principal->probarObserver();
            break;
        case 'e':
            $principal->probarEstrategy();
            break;
        case 'f':
            $principal->probarAdapter();
            break;
        case 'g':
            $principal->probarComposite();
            break;
        case 'h':  // Nuevo caso para Decorator
            $principal->probarDecorator();
            break;
        case 'z':
            echo "Saliendo...\n";
            exit;
        default:
            echo "Opción no válida. Intente nuevamente.\n";
    }

    // Espera 2 segundos antes de mostrar el menú nuevamente
    sleep(2);
}

?>