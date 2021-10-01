<?php

namespace App\Http\Controllers;

use Exception;
use App\Helpers\Helper;
use App\Models\Country;
use App\Models\Payment;
use App\Models\Classified;
use App\Models\AccountType;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\UserMembreship;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\UserMembershipParams;
use App\Models\UserMembreshipPayment;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserMembreshipResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class UserMembreshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Register()
    {
        $auth = Auth::user();
        $document_type = DocumentType::select('id', 'document')->get();
        $account_type = AccountType::select('id', 'account')->where('status', '1')->get();
        $country = Country::select('id', 'name')->get();
        $payment_methods = PaymentMethod::select('id', 'name')->get();

        $payment = Payment::all()->count();
        $payment = $payment + 2;
        // $purchase_operation_number = sprintf("%'.06d", $payment);
        $purchase_operation_number = rand(600000, 999999);

        $purchase_verification = $this->credentials($purchase_operation_number);

        return view('content.user-membreship.register', [
            'document_type' => $document_type,
            'account_type' => $account_type,
            'country' => $country,
            'id_referrer_sponsor' => $auth->id,
            'sponsor_name' => $auth->name,
            'payment_methods' => $payment_methods,
            'purchase_operation_number' => $purchase_operation_number,
            'purchase_verification' => $purchase_verification
        ]);
    }

    public function List()
    {
        return view('content.user-membreship.list');
    }

    public function GetList(Request $request): AnonymousResourceCollection
    {
        $list_user_membreship = UserMembreship::query()
            ->with(['country', 'accountType', 'documentType'])
            ->join('classified', 'user_membreships.id', '=', 'classified.id_user_membreship')
            ->get();
        return UserMembreshipResource::collection($list_user_membreship);
    }

    public function Create(Request $request)
    {
        // return $request->all();

        $msg = '';
        try {
            
            $tbRequest = $request->reserved10 == 5 ? 2 : 1;

            // if ((int)$request->errorCode == 0) :
                $user = new UserMembreship();
                $user->user = $request->reserved1;
                $user->password = Hash::make($request->reserved2);
                $user->name = $request->shippingFirstName;
                $user->last_name = $request->shippingLastName;
                $user->phone = $request->reserved4;
                $user->date_birth = $request->reserved5;
                $user->email = $request->shippingEmail;
                $user->id_referrer_sponsor = $request->reserved9;
                $user->id_country = $request->reserved8;
                $user->id_document_type = $request->reserved6;
                $user->id_account_type = $request->reserved10;
                $user->nro_document = $request->reserved7;
                $user->request = $tbRequest;
                $user->expiration_date =  strtotime('+30 days');
                $user->save();
                $id_user = $user->id; // Get ID of user

                /**
                 * store payment
                 */
                $payment = new Payment(); // payment payment
                $payment->id_user_membreship = $id_user;
                $payment->id_user_sponsor = $request->reserved9;
                $payment->amount = $request->reserved13;
                $payment->amount = $request->amount;
                $payment->operation_number = 0;
                $payment->id_payment_method = $request->reserved14;;
                $payment->save();
                $id_payment = $payment->id;                
                
                if($user->id_account_type != 5) {
                    if (auth()->user()->position == 1) {
                        Classified::create([
                            'id_user_membreship' => $id_user,
                            'id_user_sponsor' => auth()->user()->id,
                            'binary_sponsor' => 'test',
                            'position' => '0',
                            'classification' => 16,
                            'status' => '0',
                            'authorized' => '1',
                            'status_position_left' => '0',
                            'status_position_right' => '1',
                        ]);
                    } else {
                        Classified::create([
                            'id_user_membreship' => $id_user,
                            'id_user_sponsor' => auth()->user()->id,
                            'binary_sponsor' => 'test',
                            'position' => '0',
                            'classification' => 16,
                            'status' => '0',
                            'authorized' => '1',
                            'status_position_left' => '1',
                            'status_position_right' => '0',
                        ]); 
                    }
                }
             

                

                /**
                 * store user_membreships_payment
                 */
                $table = new UserMembreshipPayment();
                $table->id_user_membreship = $id_user;
                $table->id_payment = $id_payment;
                $table->authorizationCode = $request->authorizationCode;
                $table->errorCode = $request->errorCode;
                $table->idCommerce = $request->idCommerce;
                $table->shippingCity = $request->shippingCity;
                $table->txDateTime = $request->txDateTime;
                $table->purchaseOperationNumber = $request->purchaseOperationNumber;
                $table->shippingAddress = $request->shippingAddress;
                $table->card_account_type = $request->card_account_type;
                $table->answerMessage = $request->answerMessage;
                $table->bank_description = $request->bank_description;
                $table->cuota = $request->cuota;
                $table->paymentReferenceCode = $request->paymentReferenceCode;
                $table->brand = $request->brand;
                $table->purchaseVerification = $request->purchaseVerification;
                $table->IDTransaction = $request->IDTransaction;
                $table->errorMessage = $request->errorMessage;
                $table->authorizationResult = $request->authorizationResult;
                
                $table->save();

                $msg = 'Cliente Registrado satisfactoriamente';

            // else :
            //     $msg = 'Error en el registro de datos (' . $request->errorCode . ')';
            // endif;
        } catch (Exception $e) {
            // return [
            //     'status' => false,
            //     'message' => $e->getMessage(),
            // ];
             return redirect()
                 ->route('user-membreship-register')
                 ->with('error', $e->getMessage());

        }
        // return [
        //     'status' => true,
        //     'message' => $msg
        // ];

        if($tbRequest == 2) {
            return redirect()->route('virtualclass');
        }else{
            return redirect()
            ->route('user-membreship-register')
             ->with('success', $msg);
        }
     
    }

    public function getDataUser($user)
    {
        $data = UserMembreship::where('user', $user)->with('accountType')->first();
        return response()->json($data, 200);
        }

    public function getDataCurrentUser()
    {
        $data = UserMembreship::find(auth()->user()->id);
        return response()->json($data, 200);
    }

    public function changePositionCurrentUser(Request $request)
    {
        $user = UserMembreship::find(auth()->user()->id);
        $user->position = $request->position;
        $user->update();
        return response()->json($user, 200);
    }

    public function credentials($purchase_operation_number, $purchase_amount = 0)
    {
        $acquirer_id = env('ACQUIRER_ID');
        $id_commerce = env('ID_COMMERCE');
        $purchase_password = env('PURCHASE_PASSWORD');
        $purchase_currency_code = env('PURCHASE_CURRENCY_CODE');
        $purchase_verification = openssl_digest($acquirer_id . $id_commerce . $purchase_operation_number . $purchase_amount . $purchase_currency_code . $purchase_password, 'sha512');
        return $purchase_verification;
    }
}
