<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Test class untuk CRUD kelas Order
class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // test read
    public function test_show_all_orders(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // test create
    public function test_create_an_order(): void
    {
        $response = $this->post('/addOrder/1', [
            'customer_id' => 1,
            'vehicle_id' => 14
        ]);

        $response->assertStatus(302);
    }

    // test update
    public function test_update_an_order(): void
    {
        $response = $this->put('/updateOrder/19/1', [
            'customer_id' => 1,
            'vehicle_id' => 13
        ]);

        $response->assertStatus(302);
    }

    // test delete
    public function test_delete_an_order(): void
    {
        $response = $this->delete('/deleteOrder/20/1');

        $response->assertStatus(302);
    }
}
