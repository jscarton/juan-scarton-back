<?php
namespace App;
class NewCube
{
    private $_n, $cube;
    function __construct($n)
    {
        $this->_n = $n;
        $this->initCube($n);
    }
    private function initCube($_n)
    {
        for ($i = 0; $i <= $_n; $i++) {
            for ($j = 0; $j <= $_n; $j++) {
                for ($k = 0; $k <= $_n; $k++) {
                    $this->cube[$i][$j][$k] = 0;
                }
            }
        }
    }
    public function updateValueOnCube($x, $y, $z, $value)
    {
        $this->cube[$x][$y][$z] = $value;
    }
    public function queryTheCube($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $sum = 0;
        for ($i = $x1; $i <= $x2; $i++) {
            for ($j = $y1; $j <= $y2; $j++) {
                for ($k = $z1; $k <= $z2; $k++) {
                    $sum += $this->cube[$i][$j][$k];
                }
            }
        }
        return $sum;
    }
    public function getCube()
    {
        return $this->cube;
    }
    public function getN()
    {
        return $this->_n;
    }
}