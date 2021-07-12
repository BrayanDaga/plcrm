<?php

namespace Tests\Feature\AccountType;

use Tests\TestCase;
use App\Models\AccountType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateAccountTypeTest extends TestCase
{
     //nro documento no puede ser null cambiar a nullable o defualt para ejcutar test
    use RefreshDatabase;
   /** @test */
   public function can_update_account_types()
   {
       $this->withoutExceptionHandling();

       $accountType = AccountType::factory()->create(['account'=>'account1','price'=>100.0,'status'=>'1',]);

       $response = $this->putJson(route('accountType.update', [
           $accountType,
        'price' => 200.00,
        'comission' => 0.5,
        'iva' => 0.4,
        'account'=>'Account  modificado']))->assertStatus(200);
       
        $this->assertDatabaseHas('account_type', [
            'account' => 'Account  modificado',
            'price' => 200.00,
            'comission' => 0.5,
            'iva' => 0.4,
        ]);
   }
}
