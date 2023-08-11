<?php

class ToyRobotSimulator
{
    private $x;
    private $y;
    private $facing;
    private $tableWidth = 5;
    private $tableHeight = 5;
    private $directions = ['NORTH', 'EAST', 'SOUTH', 'WEST'];

    public function __construct()
    {
        
        $this->x = null;
        $this->y = null;
        $this->facing = null;
    }

    public function place($x, $y, $facing)
    {
        if ($this->isValidPosition($x, $y) && in_array($facing, $this->directions)) {
            $this->x = $x;
            $this->y = $y;
            $this->facing = $facing;
        }
    }

    public function move()
    {
        if ($this->isValidPosition($this->x, $this->y)) {
            switch ($this->facing) {
                case 'NORTH':
                    $newY = $this->y + 1;
                    if ($this->isValidPosition($this->x, $newY)) {
                        $this->y = $newY;
                    }
                    break;
                case 'EAST':
                    $newX = $this->x + 1;
                    if ($this->isValidPosition($newX, $this->y)) {
                        $this->x = $newX;
                    }
                    break;
                case 'SOUTH':
                    $newY = $this->y - 1;
                    if ($this->isValidPosition($this->x, $newY)) {
                        $this->y = $newY;
                    }
                    break;
                case 'WEST':
                    $newX = $this->x - 1;
                    if ($this->isValidPosition($newX, $this->y)) {
                        $this->x = $newX;
                    }
                    break;
            }
        }
    }

    public function left()
    {
        if ($this->isValidPosition($this->x, $this->y)) {
            $currentDirectionIndex = array_search($this->facing, $this->directions);
            $newDirectionIndex = ($currentDirectionIndex - 1 + 4) % 4;
            $this->facing = $this->directions[$newDirectionIndex];
        }
    }

    public function right()
    {
        if ($this->isValidPosition($this->x, $this->y)) {
            $currentDirectionIndex = array_search($this->facing, $this->directions);
            $newDirectionIndex = ($currentDirectionIndex + 1) % 4;
            $this->facing = $this->directions[$newDirectionIndex];
        }
    }

    public function report()
    {
        if ($this->isValidPosition($this->x, $this->y)) {
            echo $this->x . ',' . $this->y . ',' . $this->facing . PHP_EOL;
        }
    }

    private function isValidPosition($x, $y)
    {
        return $x !== null && $y !== null && $x >= 0 && $x < $this->tableWidth && $y >= 0 && $y < $this->tableHeight;
    }
}


$robot = new ToyRobotSimulator();

$robot->place(0, 0, 'NORTH');
$robot->move();
$robot->report();  // Output: 0,1,NORTH

$robot->place(0, 0, 'NORTH');
$robot->left();
$robot->report();  // Output: 0,0,WEST

$robot->place(1, 2, 'EAST');
$robot->move();
$robot->move();
$robot->left();
$robot->move();
$robot->report();  // Output: 3,3,NORTH
?>
