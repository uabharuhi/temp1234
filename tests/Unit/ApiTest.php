<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testExample2()
    {
        $this->assertTrue(true);
    }

    public function testLogin()
    {
        $response = $this->json('POST', '/patient_api/login', ['ssn' => 'test','password'=>1234]);
        #var_dump($response);
        $data = $response->getOriginalContent();
        var_dump($data);
        #$response
        #    ->assertStatus(200)
        #    ->assertJson([
        #        'token' => true,
        #]);
    }
}
