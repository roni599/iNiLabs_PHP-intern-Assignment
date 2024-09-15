<?php

require_once 'Circle.php';
require_once 'Rectangle.php';

$circle = new Circle(5);
echo "Circle Area: " . $circle->calculateArea() . " square units<br>";

echo "<br>";

$rectangle = new Rectangle(4, 8);
echo "Rectangle Area: " . $rectangle->calculateArea() . " square units<br>";
