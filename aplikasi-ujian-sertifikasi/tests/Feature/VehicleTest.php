<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// Test class untuk CRUD kelas Vehicle
class VehicleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // test read
    public function test_show_all_vehicles(): void
    {
        $response = $this->get('/vehicle');

        $response->assertStatus(200);
    }

    // test read
    public function test_show_a_vehicle(): void
    {
        $response = $this->get('/showVehicleDetails/3');

        $response->assertStatus(200);
    }

    // test create
    public function test_create_a_vehicle(): void
    {
        $response = $this->post('/addVehicle', [
            'model' => 'hahaha',
            'tahun' => '2011',
            'jumlah_penumpang' => '11',
            'manufaktur' => 'totyot',
            'harga' => 100000000,
            'jenis' => 'mobil',
            'data1' => '30',
            'data2' => '100',
            'image' => 'epiqhpxhpihweqirj.png'
        ]);

        $response->assertStatus(302);
    }

    // test update
    public function test_update_a_vehicle(): void
    {
        $response = $this->put('/updateVehicle/13', [
            'model' => 'hahahahehehe',
            'tahun' => '2011',
            'jumlah_penumpang' => '11',
            'manufaktur' => 'totyot',
            'harga' => 100000000,
            'jenis' => 'mobil',
            'data1' => '30',
            'data2' => '100',
            'image' => 'epiqhpxhpihweqirj.png'
        ]);

        $response->assertStatus(302);
    }

    // test delete
    public function test_delete_a_vehicle(): void
    {
        $response = $this->delete('/deleteVehicle/13');

        $response->assertStatus(302);
    }
}
