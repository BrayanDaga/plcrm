<!-- Incluyendo el layouts (Importante) -->
@extends('layouts.contentLayoutMaster')

<!-- Establecer el titulo del modulo (Importante) -->
@section('title', 'Mi vista')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

<!-- Codgio HTML del contenido (Importante) -->
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Botones </h4>
                </div>
                <div class="card-body">
                    <p class="card-text mb-0">
                        Lista de botones con compoenentes blade
                    </p>
                    <div class="demo-inline-spacing">
                        <x-base-button type="submit" btntype="primary"> Primary</x-base-button>
                        <x-base-button type="reset" btntype="secondary"> Primary</x-base-button>
                        <x-base-button btntype="success"> Primary</x-base-button>
                        <x-base-button btntype="danger"> Primary</x-base-button>
                        <x-base-button btntype="warning"> Primary</x-base-button>
                        <x-base-button btntype="info"> Primary</x-base-button>
                        <x-base-button btntype="dark"> Primary</x-base-button>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
@endsection
