<?php

namespace Tests\Feature\API;

use App\Models\User;
use Dingo\Api\Routing\UrlGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessToken()
    {

        $url = app(UrlGenerator::class)->version('v1');

        $this->post($url->route('api.access_token'), [
            'email'=>'default@email.com',
            'password'=>'secret'
        ])->assertStatus(200)
            ->assertExactJson(['token']);

    }

    public function testGuestAccess(){

    }
}
