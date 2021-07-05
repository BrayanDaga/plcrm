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
            'account'=>'Account de prueba',
            'iva' => 5,
            'comission' => 0.5,
            'disc_purchases' => 4,
            'pay_in_binary' =>3,
            'profit_on_purchases' => 4,
            'profit_on_purchases_2' => 1,
        ]);

         $response->assertJson([
             'data' => ['comission' => 0.5],
         ]);

        $this->assertDatabaseHas('account_type', [
            'price' => 200.00,
            'account'=>'Account de prueba',
            'iva' => 5,
            'comission' => 0.5,
            'disc_purchases' => 4,
            'pay_in_binary' =>3,
            'profit_on_purchases' => 4,
            'profit_on_purchases_2' => 1,
      ]);
    }
}
