<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Helpers\UserMembershipParams;
use App\Http\Resources\PaymentResource;
use App\Http\Resources\UserMembreshipResource;
use App\Models\DocumentType;
use App\Models\AccountType;
use App\Models\Classified;
use App\Models\Country;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\UserMembreship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class UserMembreshipController extends Controller
{
    public function Register($id_referrer_sponsor)
    {
        $sponsor = UserMembreship::find($id_referrer_sponsor);
        $document_type = DocumentType::select('id', 'document')->get();
        $account_type = AccountType::select('id', 'account')->where('status', '1')->get();
        $country = Country::select('id', 'name')->get();
        $payment_methods = PaymentMethod::select('id', 'name')->get();

        $payment = Payment::all()->count();
        $payment = $payment + 2;
        // $purchase_operation_number = sprintf("%'.06d", $payment);
        $purchase_operation_number = rand(600000,999999);

        $purchase_verification = $this->credentials($purchase_operation_number);

        return view('content.user-membreship.register', [
            'document_type' => $document_type,
            'account_type' => $account_type,
            'country' => $country,
            'id_referrer_sponsor' => $sponsor->id,
            'sponsor_name' => $sponsor->name,
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
        $table = new UserMembreship();
        $table->user = $request->reserved1;
        $table->password = Hash::make($request->reserved2);
        $table->name = $request->shippingFirstName;
        $table->last_name = $request->shippingLastName;
        $table->phone = $request->reserved4;
        $table->date_birth = $request->reserved5;
        $table->email = $request->shippingEmail;
        $table->id_referrer_sponsor = $request->reserved9;
        $table->id_country = $request->reserved8;
        $table->id_document_type = $request->reserved6;
        $table->id_account_type = $request->reserved10;
        $table->nro_document = $request->reserved7;
        $table->request = 1;

        if ($table->save()) :
            $id_user = $table->id; // Get ID of user

            // Registro del pago
            $table = new Payment(); // table payment
            $table->id_user_membreship = $id_user;
            $table->id_user_sponsor = $request->reserved9;
            $table->description = 'membreship';
            $table->amount = $request->reserved13;
            $table->operation_number = 0;
            $table->id_payment_method = $request->reserved14;
            // $table->id_bank = 1; // Default Values

            if ($table->save()) :
                $json = ['status' => 200];
            endif;

            return json_encode($json);
        endif;
    }

    public function getDataUser($user)
    {
        $data = UserMembreship::where('user', $user)->get();
        return response()->json($data, 200);
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
