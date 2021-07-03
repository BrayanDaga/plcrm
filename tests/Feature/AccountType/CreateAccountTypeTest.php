<?php

namespace Tests\Feature\AccountType;

use Tests\TestCase;
use App\Models\UserMembreship;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateAccountTypeTest extends TestCase
{
    //nro documento no puede ser null cambiar a nullable o defualt para ejcutar test
    use RefreshDatabase;
    /** @test */
    public function can_create_account_types()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('accountType.store'), [
            'price' => 200.00,
            'account'=>'Account de prueba']);

         $response->assertJson([
             'data' => ['price' => 200],
         ]);

        $this->assertDatabaseHas('account_type', [
            'account' => 'Account de prueba'
        ]);
    }
}
