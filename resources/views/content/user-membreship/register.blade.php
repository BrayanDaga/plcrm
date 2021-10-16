@extends('layouts/contentLayoutMaster')
@section('title', 'User Membreship - Register')
@section('page-style')
    <script src="https://integracion.alignetsac.com/VPOS2/js/modalcomercio.js"></script>
    <script src="https://integracion.alignetsac.com/WALLETWS/services/WalletCommerce?wsdl"></script>
@endsection

@section('content')
    {{-- <user-membreship-register
        :document-type="{{ $document_type }}"
        :account-type="{{ $account_type }}"
        :country="{{ $country }}"
        :id-referrer-sponsor="{{ $id_referrer_sponsor }}"
        :sponsor-name="'{{ $sponsor_name }}'"
        :payment-methods="{{ $payment_methods }}"
        :purchase-operation-number="'{{ $purchase_operation_number }}'"
        :acquirer-id="{{ env('ACQUIRER_ID') }}"
        :id-commerce="{{ env('ID_COMMERCE') }}"
        :purchase-currency-code="{{ env('PURCHASE_CURRENCY_CODE') }}"
        :purchase-password="'{{ env('PURCHASE_PASSWORD') }}'"
    ></user-membreship-register> --}}
    @if (session('success'))
        <div role="alert" class="alert alert-success">
            <div class="alert-body">
                <span><strong>Success </strong> {{ session('success') }}!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif


    @if (isset($errors) && $errors->any())
        <div role="alert" class="alert alert-danger">
            <div class="alert-body">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-6">
            <form name="f1" id="f1" action="{{ url('/user-membreship/create') }}" method="post" class="alignet-form-vpos2">
                @csrf
                <input type="text" name="id_referrer_sponsor" value="{{ $id_referrer_sponsor }}">
                <input type="text" name="acquirerId" value="{{ env('ACQUIRER_ID') }}">
                <input type="text" name="idCommerce" value="{{ env('ID_COMMERCE') }}">
                <input type="text" name="purchaseOperationNumber" value="{{ $purchase_operation_number }}">
                <input type="text" name="purchaseAmount">
                <input type="text" name="purchaseCurrencyCode" value="{{ env('PURCHASE_CURRENCY_CODE') }}">
                <input type="text" name="language" value="SP">
                <input type="text" name="shippingFirstName">
                <input type="text" name="shippingLastName">
                <input type="text" name="shippingEmail">
                <input type="text" name="shippingAddress" value="av.pruebas">
                <input type="text" name="shippingZIP" value="No ZIP">
                <input type="text" name="shippingCity" value="Lima">
                <input type="text" name="shippingState" value="Lima">
                <input type="text" name="shippingCountry" value="PE">
                <input type="text" name="descriptionProducts">
                <input type="text" name="programmingLanguage" value="PHP">
                <input type="text" name="purchaseVerification" value="{{ $purchase_verification }}">
                <h4>User</h4>
                <hr>
                <div class="d-flex flex-wrap">
                    <div class="form-group pr-1">
                        <label for="user">User</label>
                        {{-- <input type="text" id="user" class="form-control" name="user" onkeyup="validateUser"> --}}
                        <input type="text" id="user" class="form-control" name="user" value="{{ old('user') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password">
                    </div>
                    <div class="form-group pr-1">
                        <label for="repassword">Re-Password</label>
                        <input type="password" id="repassword" class="form-control" name="password_confirmation">
                    </div>
                    <div class="form-group pr-1">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <h4>Personal Information</h4>
                <hr>
                <div class="d-flex flex-wrap">
                    <div class="form-group pr-1">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="phone">Phones</label>
                        <input type="tel" id="phone" class="form-control" name="phone" maxlength="10" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="date_birth">Date Birth</label>
                        <input type="date" id="date_birth" class="form-control" name="date_birth" value="{{ old('date_birth') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="id_document_type">Document Type</label>
                        <select id="id_document_type" class="form-control" name="id_document_type">
                            <option value="0">--------------------</option>
                            @foreach ($document_type as $dt)
                                <option value="{{ $dt->id }}">{{ $dt->document }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group pr-1">
                        <label for="nro_document">Nro. Document</label>
                        <input type="number" id="nro_document" class="form-control" name="nro_document" maxlength="12" value="{{ old('nro_document') }}">
                    </div>
                    <div class="form-group pr-1">
                        <label for="id_country">Country</label>
                        <select id="id_country" class="form-control" name="id_country">
                            <option value="0">--------------------</option>
                            @foreach ($country as $c)
                                <option value="{{ $c->id }}" {{ $c->name == 'Perú' ? 'selected' : '' }}>
                                    {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h4>Direct Sponsor</h4>
                <hr>
                <div class="d-flex flex-wrap">
                    <div class="form-group">
                        <label for="referrer_sponsor">Referrer/Sponsor</label>
                        <input type="text" id="referrer_sponsor" class="form-control" disabled
                            value="{{ $sponsor_name }}">
                    </div>
                </div>
                <h4>Membreship Data</h4>
                <hr>
                <div class="d-flex flex-wrap">
                    <div class="form-group pr-1">
                        <label for="id_account_type">Account Type</label>
                        {{-- <select id="id_account_type" class="form-control" onchange="changeTablePrice($event)" name="id_account_type"> --}}
                        <select id="id_account_type" class="form-control" name="id_account_type">
                            <option value="0">--------------------</option>
                            @foreach ($account_type as $ct)
                                <option value="{{ $ct->id }}">{{ $ct->account }}</option>
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
                        <input type="text" id="account_type-total_cost_membreship" class="form-control" name="amount"
                            readonly>
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
                                <option value="{{ $pm->id }}">{{ $pm->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <button type="button" class="btn btn-success" id="open_modal_alignet_vpos2">Comprar</button> --}}
                <button type="submit" class="btn btn-success">Comprar</button>
            </form>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/api/user-membreship-register.js') }}"></script>
@endsection
