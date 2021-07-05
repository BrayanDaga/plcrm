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

        $accountType1 = AccountType::factory()->create(['account' => 'account 1','status'=>'1']);
        $accountType2 = AccountType::factory()->create(['account' => 'account 2','status'=>'1']);
        $accountType3 = AccountType::factory()->create(['account' => 'account 3','status'=>'1']);
        $accountType4 = AccountType::factory()->create(['account' => 'account 4','status'=>'1']);

        $response = $this->getJson(route('accountType.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'meta' => ['total' => 4]
        ]);

           $response->assertJsonStructure([
            'data', 'links' => ['prev', 'next']
           ]);       

        $this->assertEquals(
            $accountType1->id,
            $response->json('data.0.id')
        );
    }
    
}
