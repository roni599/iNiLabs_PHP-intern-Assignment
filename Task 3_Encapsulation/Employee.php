<?php

class Employee
{
    private $name;
    private $position;
    private $salary;

    public function __construct($name, $position, $salary)
    {
        $this->name = $name;
        $this->position = $position;
        $this->setSalary($salary);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function setSalary($salary)
    {
        if ($salary > 0) {
            $this->salary = $salary;
        } else {
            $this->salary = 0;
        }
    }
}

$employee = new Employee("John Doe", "Developer", 50000);

echo "Name: " . $employee->getName() . "<br>";
echo "Position: " . $employee->getPosition() . "<br>";
echo "Salary: $" . number_format($employee->getSalary(), 2) . "<br>";

$employee->setSalary(-1000);

echo "Updated Salary: $" . number_format($employee->getSalary(), 2) . "<br>";
