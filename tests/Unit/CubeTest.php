<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Cube;

class CubeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainTest()
    {
    	$cube= new Cube(4);
    	$cube->updateValueOnCube(2,2,2,4);
    	$q1=$cube->queryTheCube(1,1,1,3,3,3);
    	$this->assertInternalType('int', $q1);
    	$this->assertEquals($q1,4);
    	$cube->updateValueOnCube(1,1,1,23);
    	$q2=$cube->queryTheCube(2,2,2,4,4,4);
    	$this->assertInternalType('int', $q2);
    	$this->assertEquals($q2,4);
    	$q3=$cube->queryTheCube(1,1,1,3,3,3);
    	$this->assertInternalType('int', $q3);
    	$this->assertEquals($q3,27);
    }
}