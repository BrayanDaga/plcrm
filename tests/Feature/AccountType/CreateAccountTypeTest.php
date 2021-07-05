<?php

namespace Tests\Feature\AccountType;

use Tests\TestCase;
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
            'account' => 'Account de prueba',
            'iva' => 5,
            'comission' => 0.5,
            'disc_purchases' => 4,
            'pay_in_binary' => 3,
            'profit_on_purchases' => 4,
            'profit_on_purchases_2' => 1,
        ]);

        $response->assertJson([
            'data' => ['comission' => 0.5],
        ]);

        $this->assertDatabaseHas('account_type', [
            'price' => 200.00,
            'account' => 'Account de prueba',
            'iva' => 5,
            'comission' => 0.5,
            'disc_purchases' => 4,
            'pay_in_binary' => 3,
            'profit_on_purchases' => 4,
            'profit_on_purchases_2' => 1,
        ]);
    }

    /** @test */
    public function an_accountType_requires_a_account()
    {

        $response = $this->postJson(route('accountType.store'), [
            'account' => '',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['account']
        ]);
    }

    /** @test */
    public function an_accountType_requires_a_price()
    {

        $response = $this->postJson(route('accountType.store'), [
            'price' => '',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['price']
        ]);
    }

    /** @test */
    public function rice_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'price' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['price']
        ]);
    }

    /** @test */
    public function iva_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'iva' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['iva']
        ]);
    }
    /** @test */
    public function iva_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'iva' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['iva']
        ]);
    }

    /** @test */
    public function comission_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'comission' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['comission']
        ]);
    }

    /** @test */
    public function comission_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'comission' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['comission']
        ]);
    }

    /** @test */
    public function disc_purchases_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'disc_purchases' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['disc_purchases']
        ]);
    }

    /** @test */
    public function disc_purchases_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'disc_purchases' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['disc_purchases']
        ]);
    }

    /** @test */
    public function pay_in_binary_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'pay_in_binary' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['pay_in_binary']
        ]);
    }

    /** @test */
    public function pay_in_binary_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'pay_in_binary' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['pay_in_binary']
        ]);
    }

    /** @test */
    public function profit_on_purchases_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'profit_on_purchases' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['profit_on_purchases']
        ]);
    }

    /** @test */
    public function profit_on_purchases_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'profit_on_purchases' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['profit_on_purchases']
        ]);
    }

    /** @test */
    public function profit_on_purchases_2_must_be_a_numeric()
    {
        $response = $this->postJson(route('accountType.store'), [
            'profit_on_purchases_2' => 'sadas',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['profit_on_purchases_2']
        ]);
    }

    /** @test */
    public function profit_on_purchases_2_must_not_be_less_than_0()
    {

        $response = $this->postJson(route('accountType.store'), [
            'profit_on_purchases_2' => '-1',
        ]);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message', 'errors' => ['profit_on_purchases_2']
        ]);
    }
}
