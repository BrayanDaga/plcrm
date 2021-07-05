<?php

namespace Tests\Feature\AccountType;

use Tests\TestCase;
use App\Models\AccountType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteAccountTypeTest extends TestCase
{
    //nro documento no puede ser null cambiar a nullable o defualt para ejcutar test
    use RefreshDatabase;
  
    /** @test */
    public function can_delete_account_types()
    {
        $this->withoutExceptionHandling();

        $accountType = AccountType::factory()->create(['account'=>'account-delete','status'=>'0']);

        $response = $this->deleteJson(route('accountType.destroy', [
            $accountType,
            'status' => 1,
            ]))->assertStatus(200);

         $this->assertDatabaseHas('account_type', [
             'status' => 1
         ]);
    }
}
