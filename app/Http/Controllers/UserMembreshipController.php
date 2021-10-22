<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Payment;
use App\Models\Classified;
use App\Models\AccountType;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Models\UserMembreshipPayment;
use App\Http\Resources\UserMembreshipResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMembreshipController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
        $list_user_membreship = User::query()
            ->with(['country', 'accountType', 'documentType'])
            ->join('classified', 'users.id', '=', 'classified.user_id')
            ->get();
        return UserMembreshipResource::collection($list_user_membreship);
    }

    public function Create(UserRequest $request)
    {
        $tbRequest = $request->id_account_type == 5 ? 2 : 1;

        DB::transaction(function () use ($request, $tbRequest) {

            $user = new User();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->date_birth = $request->date_birth;
            $user->email = $request->email;
            $user->id_referrer_sponsor = $request->id_referrer_sponsor;
            $user->id_country = $request->id_country;
            $user->id_document_type = $request->id_document_type;
            $user->id_account_type = $request->id_account_type;
            $user->nro_document = $request->nro_document;
            $user->request = $tbRequest;
            $user->expiration_date =  strtotime('+30 days');
            $user->save();
            $id_user = $user->id; // Get ID of user
            /**
             * store payment
             */
            $payment = new Payment(); // payment payment
            $payment->user_id = $id_user;
            $payment->id_user_sponsor = $request->id_referrer_sponsor;
            $payment->amount = $request->reserved13;
            $payment->amount = $request->amount;
            $payment->operation_number = 0;
            $payment->id_payment_method = $request->reserved14;;
            $payment->save();
            $id_payment = $payment->id;


            $classified = '';
            $id_classified = '';
            if ($user->id_account_type != 5) {
                $fieldsClassifieds  = [
                    'user_id' => $id_user,
                    'id_user_sponsor' => auth()->user()->id,
                    'binary_sponsor' => 'test',
                    'position' => '0',
                    'classification' => 16,
                    'status' => '0',
                    'authorized' => '0',
                    'status_position_left' => '0',
                    'status_position_right' => '0',
                ];
                
                if (auth()->user()->position == 1) {
                    $fieldsClassifieds['authorized'] = 1;
                    $fieldsClassifieds['status_position_left'] = 0;
                    $fieldsClassifieds['status_position_right'] = 1;

                    $classified = Classified::create($fieldsClassifieds);
                    $id_classified = $classified->id;
                } else {
                    $fieldsClassifieds['authorized'] = 1;
                    $fieldsClassifieds['status_position_left'] = 1;
                    $fieldsClassifieds['status_position_right'] = 0;
                    $classified = Classified::create($fieldsClassifieds);
                    $id_classified = $classified->id;
                }
            }

            /**
             * store user_membreships_payment
             */
            $table = new UserMembreshipPayment();
            $table->user_id = $id_user;
            $table->id_payment = $id_payment;
            $table->authorizationCode = $request->authorizationCode ? $request->authorizationCode : '';
            $table->errorCode = $request->errorCode ? $table->errorCode : '';
            $table->idCommerce = $request->idCommerce ? $request->idCommerce : 0;
            $table->shippingCity = $request->shippingCity;
            $table->txDateTime = $request->txDateTime ? $request->txDateTime : '';
            $table->purchaseOperationNumber = $request->purchaseOperationNumber ? $request->purchaseOperationNumber : 0;
            $table->shippingAddress = $request->shippingAddress ? $request->shippingAddress : '';
            $table->card_account_type = $request->card_account_type ? $request->card_account_type : '';
            $table->answerMessage = $request->answerMessage ? $request->answerMessage : '';
            $table->bank_description = $request->bank_description ? $request->bank_description : '';
            $table->cuota = $request->cuota ? $request->cuota : '';
            $table->paymentReferenceCode = $request->paymentReferenceCode ? $request->paymentReferenceCode : '';
            $table->brand = $request->brand ? $request->brand : '';
            $table->purchaseVerification = $request->purchaseVerification ? $request->purchaseVerification : '';
            $table->IDTransaction = $request->IDTransaction ? $request->IDTransaction : '';
            $table->errorMessage = $request->errorMessage ? $request->errorMessage : '';
            $table->authorizationResult = $request->authorizationResult ? $request->authorizationResult : '';

            $table->save();
        }, 5);

        $msg = 'Cliente Registrado satisfactoriamente';
        if ($tbRequest == 2) {
            return redirect()->route('virtualclass')->withSuccess($msg);
        } else {
            return redirect()
                ->route('user-membreship-register')
                ->withSuccess($msg);
        }
    }

    public function getDataUser($user)
    {
        $data = User::where('user', $user)->with('accountType')->first();
        return response()->json($data, 200);
    }

    public function getDataCurrentUser()
    {
        $data = User::find(auth()->user()->id);
        return response()->json($data, 200);
    }

    public function changePositionCurrentUser(Request $request)
    {
        $user = User::find(auth()->user()->id);
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