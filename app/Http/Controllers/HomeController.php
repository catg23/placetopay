<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pse;
use App\Person;
use App\Payment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Muestra la pagina principal de la aplicación.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Muestra el historico de pagos realizados en la aplicacion.
     */
    public function pagos()
    {
        $pagos=DB::table('payments')
                ->join('persons','persons.id','=','payments.payer')
                ->select('payments.id as paymentId','persons.document as document', 'persons.firstName as firstName','persons.lastName as lastName','payments.description as description', 'payments.totalAmount as totalAmount','payments.transactionState as transactionState')
                ->get();
        return view('pagos',compact('pagos'));
    }

    /**
     * Muestra el formulario para registrar un pago.
     */
    public function crear_pago()
    {
        $pse=new Pse;
        $bancos=$pse->getBankList();
        $personas=Person::all();
        return view('crear_pago',compact('bancos','personas'));
    }

    /**
     * Recibi la información para registrar el pago, enviar la peticion a la Pasarela de Pago y redirecciona
     * al usuario a la pagina del banco para realizar el pago
     */
    public function guardar_pago(Request $request)
    {
        $pse=new Pse;
        $persona=Person::find($request->payer);
        $transaccion=$pse->createTransaction($request,$persona);
        if($transaccion->returnCode=='SUCCESS'){
            $pago=new Payment;
            $pago->transactionID=$transaccion->transactionID;
            $pago->bankCode=$request->bankCode;
            $pago->bankInterface=$request->bankInterface;
            $pago->reference=$request->reference;
            $pago->description=$request->description;
            $pago->bankInterface=$request->bankInterface;
            $pago->totalAmount=$request->totalAmount;
            $pago->taxAmount=0;
            $pago->devolutionBase=0;
            $pago->ipAddress=$request->ip();
            $pago->payer=$persona->id;
            $pago->userAgent=$request->userAgent();
            $pago->trazabilityCode=$transaccion->trazabilityCode;
            $pago->responseReasonText=$transaccion->responseReasonText;
            $pago->save();
            return redirect($transaccion->bankURL);
        }
    }

    /**
     * Recibe la respuesta incial al finalizar el proceso de pago desde la pasarela de pago
     */
    public function respuesta_pago($reference)
    {
        $pse=new Pse;
        $pago=Payment::where('reference','=',$reference)->first();
        $peticion=$pse->getTransactionInformation($pago->transactionID);
        $respuesta= $peticion->getTransactionInformationResult;
        $pago->transactionState=$respuesta->transactionState;
        $pago->responseReasonText=$respuesta->responseReasonText;
        $pago->update();
        return redirect()->route('pagos')->withFlashSuccess('PSE: '.$respuesta->responseReasonText);
    }

    /**
     * Muestra el detalle del pago registrado en la base de datos.
     */
    public function detalles_pago($pago)
    {
        $consulta=DB::table('payments')
                ->join('persons','persons.id','=','payments.payer')
                ->select('payments.id as paymentId','persons.documentType as documentType','persons.document as document', 'persons.firstName as firstName','persons.lastName as lastName','persons.emailAddress as emailAddress','persons.phone as phone','payments.transactionID as transactionID','payments.description as description', 'payments.totalAmount as totalAmount','payments.transactionState as transactionState','payments.reference as reference','payments.ipAddress as ipAddress','payments.userAgent as userAgent','payments.trazabilityCode as trazabilityCode', 'payments.updated_at as updated_at','payments.responseReasonText as responseReasonText')
                ->where('payments.id','=',$pago)
                ->first();      
        return view('detalles_pago',compact('consulta'));
    }
}
