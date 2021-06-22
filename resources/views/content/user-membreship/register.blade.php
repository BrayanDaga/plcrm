@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('content')
    <user-membreship-register  :document-type="{{ $document_type }}" :account-type="{{ $account_type }}"></user-membreship-register>
@endsection
