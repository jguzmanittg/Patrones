<?php

// Interfaz Estrategia
interface MetodoPago {
    public function pagar(float $cantidad): void;
}

// Estrategia concreta: Pago con BitCoin
class PagoBitCoin implements MetodoPago {
    public function pagar(float $cantidad): void {
        // entrar en el portal x.y.z
        // hacer una transferencia electronica
        //
        echo "Pagando $cantidad con bit coins.\n";
    }
}

// Estrategia concreta: Pago con PayPal
class PagoPayPal implements MetodoPago {
    public function pagar(float $cantidad): void {
        echo "Pagando $cantidad con PayPal.\n";
    }
}

// Estrategia concreta: Pago con PayPal
class PagoEfectivo implements MetodoPago {
    public function pagar(float $cantidad): void {
        // sacar la cartera....
        echo "Pagando $cantidad en billetes y monedas.\n";
    }
}


// Contexto que usa las estrategias
class ProcesadorPago {
    private MetodoPago $metodoPago;

    public function __construct(MetodoPago $metodoPago) {
        $this->metodoPago = $metodoPago;
    }

    public function setMetodoPago(MetodoPago $metodoPago): void {
        $this->metodoPago = $metodoPago;
    }

    public function procesarPago(float $cantidad): void {
        $this->metodoPago->pagar($cantidad);
    }
}

// Uso del patrón Strategy
$metodoPagoBitCoin = new PagoBitCoin();
$metodoPagoPayPal = new PagoPayPal();


$procesador = new ProcesadorPago($metodoPagoBitCoin);
$procesador->procesarPago(100); // Pagando 100 con bit coins.

$procesador->setMetodoPago($metodoPagoPayPal);
$procesador->procesarPago(200); // Pagando 200 con PayPal.

//////
$metodoPagoEfectivo = new PagoEfectivo();
$procesador = new ProcesadorPago($metodoPagoEfectivo);
$procesador->procesarPago(200);



