<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ApiTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * Test Cube and CubePoint with this test case 
     * 4 5
     * UPDATE 2 2 2 4
     * QUERY 1 1 1 3 3 3
     * UPDATE 1 1 1 23
     * QUERY 2 2 2 4 4 4
     * QUERY 1 1 1 3 3 3
     *
     * @return void
     */
    public function testAPI()
    {
        $response = $this->json('POST', '/api', ['user_input' => "2\n4 5\nUPDATE 2 2 2 4\nQUERY 1 1 1 3 3 3\nUPDATE 1 1 1 23\nQUERY 2 2 2 4 4 4\nQUERY 1 1 1 3 3 3\n2 4\nUPDATE 2 2 2 1\nQUERY 1 1 1 1 1 1\nQUERY 1 1 1 2 2 2\nQUERY 2 2 2 2 2 2"]);

        $response->assertStatus(200)->assertJson([4,4,27,0,1,1]);
    }
}
