<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testViewingCustomerPage()
    {
        $response = $this->get('/customers');

        $response->assertStatus(200);
        $response->assertSee('Name');
        $response->assertSee('# of Orders');
        $response->assertSee('Juanita Jones');
        $response->assertSee('3');
        $response->assertDontSee('Hoa Phan');
    }
}
