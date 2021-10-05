@extends('layouts.contentLayoutMaster')
@section('title', 'BinaryCut')

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
@endsection

@section('content')
    <div class="table-responsive">
        <table id="datatable" class="table table-bordered">
            <tr>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
            </tr>
            @foreach ($users as $user)
        <tr>
            <td> {{ $user->fullName }} </td>
            <td> {{ $user->LeftPoints }} </td>
            <td> {{ $user->RightPoints }} </td>
            <td> {{ $user->LeftPoints < $user->RightPoints ? $user->LeftPoints * 0.5  :  $user->RightPoints * 0.5 }} </td>
        </tr>
              
            @endforeach
        </table>
    </div>

@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-toastr.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/extensions/ext-component-sweet-alerts.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/components/components-alerts.js')) }}"></script>
@endsection
