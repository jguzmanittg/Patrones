<?php

class Carro {
    private string $marca;
    private string $modelo;
    private string $color;
    private string $motor;

    // Constructor privado para forzar el uso del builder
    private function __construct() {}

    public function __toString(): string {
        return "Carro [marca={$this->marca}, modelo={$this->modelo}, color={$this->color}, motor={$this->motor}]";
    }

    // Método estático para obtener una instancia del Builder
    public static function builder(): CarroBuilder {
        return new CarroBuilder();
    }

    // Clase Builder separada
    public static function construir(CarroBuilder $builder): Carro {
        $carro = new Carro();
        $carro->marca = $builder->getMarca();
        $carro->modelo = $builder->getModelo();
        $carro->color = $builder->getColor();
        $carro->motor = $builder->getMotor();
        return $carro;
    }
}

class CarroBuilder {
    private ?string $marca = null;
    private ?string $modelo = null;
    private ?string $color = null;
    private ?string $motor = null;

    public function setMarca(string $marca): self {
        $this->marca = $marca;
        return $this;
    }

    public function setModelo(string $modelo): self {
        $this->modelo = $modelo;
        return $this;
    }

    public function setColor(string $color): self {
        $this->color = $color;
        return $this;
    }

    public function setMotor(string $motor): self {
        $this->motor = $motor;
        return $this;
    }

    public function build(): Carro {
        return Carro::construir($this);
    }

    // Métodos getters para permitir acceso a los atributos desde Carro
    public function getMarca(): ?string {
        return $this->marca;
    }

    public function getModelo(): ?string {
        return $this->modelo;
    }

    public function getColor(): ?string {
        return $this->color;
    }

    public function getMotor(): ?string {
        return $this->motor;
    }
}

// Uso del patrón Builder en PHP
$carro = Carro::builder()
    ->setMarca("Toyota")
    ->setModelo("Corolla")
    ->setColor("Rojo")
    ->setMotor("1.8L")
    ->build();

echo $carro;
