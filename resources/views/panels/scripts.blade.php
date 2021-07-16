{{-- Vendor Scripts --}}
<script src="https://integracion.alignetsac.com/WALLETWS/services/WalletCommerce?wsdl"></script>
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
@yield('vendor-script')
{{-- Theme Scripts --}}
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>
@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<script src="{{ asset(mix('js/app.js')) }}"></script>
{{-- page script --}}
@yield('page-script')
{{-- page script --}}
