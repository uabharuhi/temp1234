<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Patient;
use App\Reservation;

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
        #$response = $this->json('POST', '/patient_api/login', ['ssn' => 'test','password'=>1234]);
        #var_dump($response);
        #$data = $response->getOriginalContent();
        #var_dump($data);
        #$response
        #    ->assertStatus(200)
        #    ->assertJson([
        #        'token' => true,
        #]);
    }

    public function testForeignkey(){
        $patient3 = Patient::where('ssn', 'test2')->first() ;
        $reservation = Reservation::where('patient_id', '3')->get() ;
        #var_dump( $patient3->patinet() );
        #var_dump( $reservation->patient()->first()->ssn );
        #var_dump( $reservation->patient()->first()->name );
        var_dump( $patient3->reservations[0]->patient_id );
        var_dump( $patient3->reservations[0]->date );
        #assert( $patient3->reservations[0]->date == "2017-08-07");      
    }
}
