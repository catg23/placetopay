<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Pse;

class GeneralTest extends TestCase
{
    
    function testRegisterTest()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }       
    function testLogin()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get('/home');
        $response->assertStatus(200);
        return $user;
    }

    /**
     * Lista de Entidades Bancarias recibidas
     * Verifica que sea de tipo "array"
     * @return [type] [description]
     */
    function testGetBanksList()
    {
        $pse=new Pse;
        $response=$pse->getBankList();
        $this->assertInternalType('array',$response);
        return $response;
    }

    /**
     * Verifica que se reciba el listado de bancos correctamente
     * @param  array $response
     * @depends testGetBanksList
     */
    function testVerifiBanksList($response){
        $this->assertEquals('BANCO UNION COLOMBIANO',$response[29]->bankName);
        return $response[29]->bankCode;
    }

    /**
     * Validar autenticacion antes de realizar un pago
     * @depends testLogin
     * @depends testVerifiBanksList
     */
    function testCrearPagoNotAuth($user,$bankCode)
    {
        
        $request = [
            'bankInterface' => 0,
            'payer' => $user->id,
            'bankCode' => $bankCode,
            'description' => 'Prueba de Pago',
            'totalAmount' => 10000
            ];

            $response = $this->json('POST', '/pago/guardar',$request);
            $response->assertStatus(401);
            //$response->assertJson(['message' => "Unauthenticated."]);
    }

    /**
     * Realizar pago
     * @depends testLogin
     * @depends testVerifiBanksList
     */
    function testCrearPagoAuth($user,$bankCode)
    {
       
        $request = [
            'bankInterface' => 0,
            'payer' => 1,
            'bankCode' => $bankCode,
            'description' => 'Prueba de Pago',
            'totalAmount' => 10000,
            '_token' => csrf_token(),
            'reference' => md5(date('c'))
            ];

            $response = $this->actingAs($user)->json('POST', '/pago/guardar',$request);
            $response->assertStatus(302);
            return $response;
    }

    /**
     * Verificar Redirección de Pago
     * @depends testCrearPagoAuth
     */
    
    function testRedireccion($response)
    {
        $this->assertContains('Redirecting to <a href="https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.aspx',$response->getContent());
    }
}
