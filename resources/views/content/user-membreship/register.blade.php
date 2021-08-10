@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('page-style')
    <script src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js"></script>
    <script src="https://integracion.alignetsac.com/WALLETWS/services/WalletCommerce?wsdl"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script> --}}
@endsection

@section('content')
    <user-membreship-register
        :document-type="{{ $document_type }}"
        :account-type="{{ $account_type }}"
        :country="{{ $country }}"
        :id-referrer-sponsor="{{ $id_referrer_sponsor }}"
        :sponsor-name="'{{ $sponsor_name }}'"
        :payment-methods="{{ $payment_methods }}"
        :purchase-operation-number="'{{ $purchase_operation_number }}'"
    ></user-membreship-register>
@endsection
@section('page-script')

{{-- <script src="{{asset('js/api/user-membreship-register.js')}}"></script> --}}
@endsection