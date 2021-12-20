<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /*public function testBasicTest()
    {
        $response = $this->get('/test');
        $response->assertStatus(200);
        $this->assertIsString($response->getContent());
        //$response->assertLocation(url('/test'));
        //$response->assertSee('Meal');
    }
*/
    public function testGetAllUsersNoAuth()
    {
        /*$response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');*/
        //Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'canteen01',
            'password' => 'ctn123456',
            '_token' => csrf_token()
        ]);
        $response->assertLocation(url('/canteen'));
        $response->assertSuccessful();
        //$this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('auth.login', $response->original->name());
    }
}
