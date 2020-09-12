<?php

class SumOfTwo
{
    private $x;
    private $y;
    private $data=[];
    public function __get($x)
    {
        if (isset($this->data[$x]))
        {
            return $this->data[$x];
        }
    }
    public function __set($x,$value)
    {
        if (property_exists($this,"{$x}"))
        {
            $this->data[$x]=$value;
        }
        else
        {
            echo 'Property doesn\'t exist<br>';
        }
    }
    public function __construct($x=0,$y=0)
    {
        $this->x=$x;
        $this->y=$y;
    }
}
$b=new SumOfTwo();
$b->x=3;
$b->y=5;
$b->z=6;
echo $b->x+$b->y;
var_dump($b);


class Car
{
    private $data=[];
    public function __call($x, $args)
    {
        $method = substr($x,0,3);
        switch ($method)
        {
            case 'get':
                $property='_'.strtolower(substr($x,3));
                return $this->data[$property];
                break;
            case 'set':
                $property='_'.strtolower(substr($x,3));
                $this->data[$property]=$args[0];
                break;
            case 'has':
                $property='_'.strtolower(substr($x,3));
                return (isset($this->data[$property])) ? 'true' : 'false';
                break;
            case 'uns':
                $property='_'.strtolower(substr($x,3));
                unset($this->data[$property]);
                break;
            default:
                throw new Exception(" Action doesn't exist");
        }
    }
}
$car= new Car();
try {
    $car->setModel('A3');
    $car->setYear('2007');
    echo $car->getModel().'<br>';
    echo $car->getYear().'<br>';
    echo $car->hasYear().'<br>';
    $car->unsModel();
} catch (Exception $e){
    echo $e->getMessage();
}
