<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Test class untuk CRUD kelas Customer
class CustomerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // test read
    public function test_show_all_customers(): void
    {
        $response = $this->get('/customer');

        $response->assertStatus(200);
    }

    // test read
    public function test_show_a_customer(): void
    {
        $response = $this->get('/showCustomerDetails/1');

        $response->assertStatus(200);
    }

    // test create
    public function test_create_a_customer(): void
    {
        $response = $this->post('/addCustomer', [
            'nama' => 'fghj',
            'alamat' => 'jalan fghj',
            'no_telp' => '0981283091823',
            'id_card' => '76394176329746'
        ]);

        $response->assertStatus(302);
    }

    // test update
    public function test_update_a_customer(): void
    {
        $response = $this->put('/updateCustomer/1', [
            'nama' => 'asdf',
            'alamat' => 'jalan fghj',
            'no_telp' => '0981283091823',
            'id_card' => '76394176329746'
        ]);

        $response->assertStatus(302);
    }

    // test delete
    public function test_delete_a_customer(): void
    {
        $response = $this->delete('/deleteCustomer/3');

        $response->assertStatus(302);
    }
}
