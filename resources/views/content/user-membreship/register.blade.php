@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('content')
    <user-membreship-register
        :document-type="{{ $document_type }}"
        :account-type="{{ $account_type }}"
        :country="{{ $country }}"
        :id-referrer-sponsor="{{ $id_referrer_sponsor }}"
        :sponsor-name="'{{ $sponsor_name }}'"
        :payment-methods="{{ $payment_methods }}"
    ></user-membreship-register>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/api/alignetsac.js')) }}"></script>
@endsection