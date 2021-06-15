<!-- Incluyendo el layouts -->
@extends('layouts/contentLayoutMaster')

<!-- Establecer el titulo del modulo -->
@section('title', 'Test App')

<!-- Indicar los estilos de la plantilla -->
@section('vendor-style')
@endsection

<!-- Indicar los estilos personalizados -->
@section('page-style')
@endsection

<!-- Codgio HTML del contenido -->
@section('content')
<h2>Texto desde BLADE</h2>
<test></test>
@endsection

<!-- Indicarlo los script de la plantilla -->
@section('vendor-script')
@endsection

<!-- Inbdicar los script personalizado -->
@section('page-script')
@endsection