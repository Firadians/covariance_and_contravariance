<?php

namespace Data;

#inheritance 


abstract class Animal{
    public string $name;

    abstract public function run(): void;

    #tambahan untuk contravariance
    abstract public function eat(AnimalFood $animalFood): void;

}

class Cat extends Animal{
    public function run(): void{
        echo "Cat $this->name is running" . PHP_EOL;
    }

    #tambahan untuk contravariance
    public function eat(AnimalFood $animalFood):void{
        echo "Cat $this->name is Eating" . PHP_EOL;
        }
}

class Dog extends Animal{
    public function run(): void{
        echo "Dog $this->name is running" . PHP_EOL;
    }

    #tambahan untuk contravariance
    public function eat(Food $animalFood): void{
        echo "Dog $this->name is eating" . PHP_EOL;
    }
}

#COVARIANCE DIMULAI DISINI

interface AnimalShelter{
    function adopt(string $name): Animal;
}

class CatShelter implements AnimalShelter{
    public function adopt(string $name): Cat
    {
        $cat = new Cat();
        $cat->name = $name;
        return $cat;
    }
}

class DogShelter implements AnimalShelter{
    public function adopt(string $name): Dog
    {
        $dog = new Dog();
        $dog->name = $name;
        return $dog;
    }
}

#CLASS UNTUK CONTRAVARIANCE
class Food{

}

class AnimalFood extends Food{

}


#TEST COVARIANCE
$catShelter = new CatShelter();

$cat = $catShelter->adopt("Luna");
$cat->run();

$dogShelter = new DogShelter();
$dog = $dogShelter->adopt("Doge");
$dog->run();

#TEST CONTRAVARIANCE
$catShelter = new CatShelter();
$cat = $catShelter->adopt("Luna");
$cat->eat(new AnimalFood());

$dogShelter = new DogShelter();
$dog = $dogShelter->adopt("Doge");
$dog->eat(new Food());
