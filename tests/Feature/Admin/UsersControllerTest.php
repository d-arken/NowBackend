<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGuestAccessListUsers()
    {
       $page= $this->get(route('user.index'));
       $page->assertRedirect(route('login'));
    }

    public function testLoggedUserAccessListUsers(){
        Model::unguard();
        $user = factory(User::class)
            ->states('admin')
            ->create(['verified'=>true]);

        $this->actingAs($user)
            ->get(route('user.index'))
        ->assertSee('Usuários ');
    }
}
