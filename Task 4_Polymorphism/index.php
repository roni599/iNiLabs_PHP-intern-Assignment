<?php

require_once 'Dog.php';
require_once 'Cat.php';

$animals = [
    new Dog(),
    new Cat()
];

foreach ($animals as $animal) {
    echo $animal->makeSound() . "<br>";
}
?>
