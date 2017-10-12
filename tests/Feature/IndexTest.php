<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
*   IndexTest
    @description: este test prueba que cargue correctamente el UI del App
*/
class IndexTest extends TestCase
{
    /**
     * loads the index.
     *
     * @return void
     */
    public function testLoadTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
