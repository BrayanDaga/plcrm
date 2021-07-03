@extends('layouts/contentLayoutMaster')
@section('title', 'User Request')
@section('content')
    <user-request :all-user-requesting="{{ $all_user_requesting }}"></user-request>
@endsection
