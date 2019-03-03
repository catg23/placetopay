<?php	

namespace App;
use SoapClient;
use SoapHeader;

use Illuminate\Support\Facades\Cache;
/**
 * Clase Pse pago electronicos
 */
class Pse 
{
	protected $login;
	protected $tranKey;
	protected $wsdl;
	protected $endpoint;
	protected $auth;
	
	function __construct()
	{
		$this->login = env('PLACETOPAY_LOGIN');
		$this->tranKey = env('PLACETOPAY_TRANSKEY');
		$this->wsdl = env('PLACETOPAY_WSDL');
		$this->endpoint = env('PLACETOPAY_ENDPOINT');
		$seed=date('c');
		$this->auth=array(
			'login'=>$this->login,
			'tranKey'=>sha1($seed.$this->tranKey),
			'seed'=>$seed
		);
	}

	public function getBankList()
	{	
		
		$bancos=[];
		if (Cache::has('bankList')) {
		   $bancos=Cache::get('bankList');
		}else{
			$soap = new SoapClient($this->wsdl);
        	$data = $soap->getBankList(['auth'=>$this->auth]);
			Cache::put('bankList',$data->getBankListResult->item, 1200);
			$bancos=Cache::get('bankList');
		} 			
        return $bancos;
	}

	public function createTransaction($request,$persona)
	{
		$peticion=array(
			'bankCode'=>$request->bankCode,
			'bankInterface'=>$request->bankInterface,
			'reference'=>$request->reference,
			'language'=>'ES',
			'currency'=>'COP',
			'description'=>$request->description,
			'totalAmount'=>$request->totalAmount,
			'taxAmount'=>'0',
			'devolutionBase'=>'0',
			'payer'=>$persona,
			'ipAddress'=>$request->ip(),
			'userAgent'=>$request->userAgent(),
			'returnURL'=>env('APP_URL').'/pago/respuesta/'.$request->reference
		);
		$soap = new SoapClient($this->wsdl);
        $data = $soap->createTransaction(['auth'=>$this->auth,'transaction'=>$peticion]);
        return $data->createTransactionResult;
	}

	public function getTransactionInformation($transactionID)
	{
		$soap = new SoapClient($this->wsdl);
        $data = $soap->getTransactionInformation(['auth'=>$this->auth,'transactionID'=>$transactionID]);
        return $data;
	}
 
}

?>