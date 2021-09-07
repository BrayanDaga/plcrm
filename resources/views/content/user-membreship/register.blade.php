@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('page-style')
<script src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js"></script>
<script src="https://integracion.alignetsac.com/WALLETWS/services/WalletCommerce?wsdl"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <form name="f1" id="f1" action="{{ url('/api/user-membreship/create') }}" method="post" class="alignet-form-vpos2">
            @csrf
            <input type="hidden" name="reserved9" value="{{ $id_referrer_sponsor }}">
            <input type="hidden" name="acquirerId" value="{{ env('ACQUIRER_ID') }}">
            <input type="hidden" name="idCommerce" value="{{ env('ID_COMMERCE') }}">
            <input type="hidden" name="purchaseOperationNumber" value="{{ $purchase_operation_number }}">
            <input type="hidden" name="purchaseAmount">
            <input type="hidden" name="purchaseCurrencyCode" value="{{ env('PURCHASE_CURRENCY_CODE') }}">
            <input type="hidden" name="language" value="SP">
            <input type="hidden" name="shippingFirstName">
            <input type="hidden" name="shippingLastName">
            <input type="hidden" name="shippingEmail">
            <input type="hidden" name="shippingAddress" value="av.pruebas">
            <input type="hidden" name="shippingZIP" value="No ZIP">
            <input type="hidden" name="shippingCity" value="Lima">
            <input type="hidden" name="shippingState" value="Lima">
            <input type="hidden" name="shippingCountry" value="PE">
            <input type="hidden" name="descriptionProducts">
            <input type="hidden" name="programmingLanguage" value="PHP">
            <input type="hidden" name="purchaseVerification" value="{{ $purchase_verification }}">
            <h4>User</h4>
            <hr>
            <div class="d-flex flex-wrap">
                <div class="form-group pr-1">
                    <label for="user">User</label>
                    <input type="text" id="user" class="form-control" name="reserved1">
                </div>
                <div class="form-group pr-1">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="reserved2">
                </div>
                <div class="form-group pr-1">
                    <label for="repassword">Re-Password</label>
                    <input type="password" id="repassword" class="form-control" name="reserved3">
                </div>
                <div class="form-group pr-1">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" name="email">
                </div>
            </div>
            <h4>Personal Information</h4>
            <hr>
            <div class="d-flex flex-wrap">
                <div class="form-group pr-1">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" name="name">
                </div>
                <div class="form-group pr-1">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" class="form-control" name="last_name">
                </div>
                <div class="form-group pr-1">
                    <label for="phone">Phones</label>
                    <input type="tel" id="phone" class="form-control" name="reserved4" maxlength="10">
                </div>
                <div class="form-group pr-1">
                    <label for="date_birth">Date Birth</label>
                    <input type="date" id="date_birth" class="form-control" name="reserved5">
                </div>
                <div class="form-group pr-1">
                    <label for="id_document_type">Document Type</label>
                    <select id="id_document_type" class="form-control" name="reserved6">
                        <option value="0">--------------------</option>
                        @foreach ($document_type as $dt)
                            <option value="{{ $dt->id }}">{{ $dt->document}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pr-1">
                    <label for="nro_document">Nro. Document</label>
                    <input type="number" id="nro_document" class="form-control" name="reserved7" maxlength="12">
                </div>
                <div class="form-group pr-1">
                    <label for="id_country">Country</label>
                    <select id="id_country" class="form-control" name="reserved8">
                        <option value="0">--------------------</option>
                        @foreach ($country as $c)
                            <option value="{{ $c->id }}" {{ ($c->name == 'Perú' ? 'selected' : '') }}>{{ $c->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <h4>Direct Sponsor</h4>
            <hr>
            <div class="d-flex flex-wrap">
                <div class="form-group">
                    <label for="referrer_sponsor">Referrer/Sponsor</label>
                    <input type="text" id="referrer_sponsor" class="form-control" disabled value="{{ $sponsor_name}}">
                </div>
            </div>
            <h4>Membreship Data</h4>
            <hr>
            <div class="d-flex flex-wrap">
                <div class="form-group pr-1">
                    <label for="id_account_type">Account Type</label>
                    <select id="id_account_type" class="form-control" name="reserved10">
                        <option value="0">--------------------</option>
                        @foreach ($account_type as $ct)
                            <option value="{{ $ct->id }}">{{ $ct->account}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pr-1">
                    <label for="account_type-price">Price</label>
                    <input type="text" id="account_type-price" class="form-control" disabled>
                </div>
                <div class="form-group pr-1">
                    <label for="account_type-iva">IVA</label>
                    <input type="text" id="account_type-iva" class="form-control" disabled>
                </div>
                <div class="form-group pr-1">
                    <label for="account_type-total_cost_membreship">Total cost of Membreship</label>
                    <input type="text" id="account_type-total_cost_membreship" class="form-control" disabled>
                    <input type="hidden" name="reserved13">
                </div>
            </div>
            <h4>Payment Methods</h4>
            <div class="d-flex flex-wrap">
                <div class="form-group pr-1">
                    <label for="id_payment_method">Select Type of Payment</label>
                    <select id="id_payment_method" class="form-control" name="reserved14">
                        <option value="0">--------------------</option>
                        @foreach ($payment_methods as $pm)
                            <option value="{{ $pm->id }}">{{ $pm->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="button" class="btn btn-success" id="open_modal_alignet_vpos2">Comprar</button>
            {{-- <button type="submit" class="btn btn-success">Comprar</button> --}}
        </form>
    </div>
</div>
@endsection
@section('page-script')
<script src="{{asset('js/api/user-membreship-register.js')}}"></script>
@endsection
