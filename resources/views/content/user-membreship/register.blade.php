@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('content')
    <user-membreship-register :document-type="{{ $document_type }}" :account-type="{{ $account_type }}" :auth="{{ $get_auth_config }}"></user-membreship-register>
@endsection
