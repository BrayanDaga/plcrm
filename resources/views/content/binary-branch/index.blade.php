<!-- Incluyendo el layouts (Importante) -->
@extends('layouts.contentLayoutMaster')

<!-- Establecer el titulo del modulo (Importante) -->
@section('title', 'Binary Branch')

<!-- Indicar los estilos de la plantilla (OPCIONAL) -->
@section('vendor-style')
@endsection

<!-- Indicar los estilos personalizados (Opcional) -->
@section('page-style')
@endsection

<!-- Codgio HTML del contenido (Importante) -->
@section('content')
    <binary-branch></binary-branch>
@endsection

<!-- Indicarlo los script de la plantilla (Opcional) -->
@section('vendor-script')
@endsection

<!-- Inbdicar los script personalizado (Opcional) -->
@section('page-script')
@endsection