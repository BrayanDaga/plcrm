<?php

namespace Tests\Feature\AccountType;

use App\Models\AccountType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListAccountTypeTest extends TestCase
{    
    //nro documento no puede ser null cambiar a nullable o defualt para ejcutar test
    use RefreshDatabase;   
    /** @test */
    public function can_get_all_acount_types()
    {
        $this->withoutExceptionHandling();

        $accountType1 = AccountType::factory()->create(['account' => 'account 1','status'=>'1','created_at' => now()->subDays(4)]);
        $accountType2 = AccountType::factory()->create(['account' => 'account 2','status'=>'1','created_at' => now()->subDays(3)]);
        $accountType3 = AccountType::factory()->create(['account' => 'account 3','status'=>'1','created_at' => now()->subDays(2)]);
        $accountType4 = AccountType::factory()->create(['account' => 'account 4','status'=>'1','created_at' => now()->subDays(1)]);

        $response = $this->getJson(route('accountType.index'));

        $response->assertSuccessful();

          $response->assertJson([
          'total' => 4
          ]);
          $response->assertJsonStructure([
             'data', 'total', 'first_page_url', 'last_page_url'
          ]);       

         $this->assertEquals(
             $accountType4->id,
             $response->json('data.0.id')
         );
    }
    
}
