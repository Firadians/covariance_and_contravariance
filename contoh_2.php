<?php

abstract class Kendaraan
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract public function isiBensin();

    public function jalan(jalanGang $jalan)
    {
        echo $this->name . " menuju ke " . get_class($jalan);
    }
}

class Motor extends Kendaraan
{
    public function isiBensin()
    {
        echo $this->name . " mengisi 3 liter";
    }
}

class Mobil extends Kendaraan
{
    public function isiBensin()
    {
        echo $this->name . " mengisi 10 liter";
    }

    public function jalan(jalan $jalan) {
        echo $this->name . " menuju ke " . get_class($jalan); // parameter pada function nilainya less spesific
    }
}

interface sewaKendaraan
{
    public function sewa(string $name): Kendaraan;
}

class sewaMotor implements sewaKendaraan
{
    public function sewa(string $name): Motor // alih-alih mengembalikan tipe kelas Kendaraan, dapat direturn dengan tipe Motor
    {
        return new Motor($name);
    }
}

class sewaMobil implements sewaKendaraan
{
    public function sewa(string $name): Mobil // alih-alih mengembalikan tipe kelas Kendaraan, dapat direturn dengan tipe Mobil
    {
        return new Mobil($name);
    }
}

class jalan {}

class jalanGang extends jalan {}

$motor = (new sewaMotor)->sewa("Ricky");
$motor->isiBensin();
echo "\n";

$mobil = (new sewaMobil)->sewa("Mavrick");
$mobil->isiBensin();
echo "\n";

$motor = (new sewaMotor)->sewa("Ricky");
$gangKalimantan = new jalanGang();
$motor->jalan($gangKalimantan);
echo "\n";

$mobil = (new sewaMobil)->sewa("Mavrick");
$jalanRaya = new jalan();
$mobil->jalan($jalanRaya);