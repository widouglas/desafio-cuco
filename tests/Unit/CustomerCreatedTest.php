<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerCreatedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testListCustomers()
    {
        $response = $this->get('/api/customers');
        $response->assertStatus(200);
    }

    public function testNewCustomer()
    {
        $data = [
            "name" => "José dos Santos",
            "cpf" => "61452209456",
            "birthdate" => "1975-01-10"
        ];

        if (!$this->CPFExisted($data["cpf"])) {
            $response = $this->call('POST', '/api/customers', $data);
            $this->assertEquals(200, $response->status());
        }
    }

    public function testNewCustomerWithCPFExisted()
    {
        $data = [
            "name" => "José dos Santos",
            "cpf" => "61452209456",
            "birthdate" => "1975-01-10"
        ];

        if ($this->CPFExisted($data["cpf"])) {
            $response = $this->call('POST', '/api/customers', $data);
            $this->assertEquals(500, $response->status());
        }
    }

    public function testNewCustomerWithoutName()
    {
        $data = [
            "cpf" => "42478408864",
            "birthdate" => "1975-01-10"
        ];

        $response = $this->call('POST', '/api/customers', $data);
        $this->assertEquals(400, $response->status());
    }

    public function testNewCustomerWithoutCPF()
    {
        $data = [
            "name" => "José dos Santos",
            "birthdate" => "1975-01-10"
        ];

        $response = $this->call('POST', '/api/customers', $data);
        $this->assertEquals(400, $response->status());
    }

    public function testSearchName()
    {
        $name = "José dos Santos";
        $response = $this->get("/api/customers/findBy?name={$name}");
        $this->assertEquals(200, $response->status());
    }

    public function testSearchCPF()
    {
        $cpf = "42478408864";
        $response = $this->get("/api/customers/findBy?cpf={$cpf}");
        $this->assertEquals(200, $response->status());
    }

    public function CPFExisted($cpf)
    {
        $response = $this->get("/api/customers/findBy?cpf={$cpf}");
        if (count($response->getOriginalContent()))
            return true;
        return false;
    }
}
