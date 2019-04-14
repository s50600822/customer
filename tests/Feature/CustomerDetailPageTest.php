<?php

namespace Tests\Feature;

use Tests\TestCase;

class CustomerDetailPageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testViewingCustomerDetailPageWithValidCustomerID()
    {
        $response = $this->get('/customers/10');

        $response->assertStatus(200);
        $response->assertSee('Juanita&#039;s Order History');
        $response->assertSee('Date');
        $response->assertSee('# of Products');
        $response->assertSee('Total');
        $response->assertSee('<td colspan="2">Lifetime Value</td>');

        $response->assertDontSee('Hoa Phan');
    }

    public function testViewingCustomerDetailPageWithINVALIDCustomerID()
    {
        $response = $this->get('/customers/nanana');

        $response->assertStatus(200);
        $response->assertSee('Sorry: Something went wrong, please check application log for more detail.');
    }
}
