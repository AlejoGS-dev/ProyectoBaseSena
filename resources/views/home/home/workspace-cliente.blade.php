@extends('home.layouts.app')

@section('title', 'Workspace | Cliente')
@section('menu-workspace-cliente', 'active')

@push('styles')
<link href="{{ asset('css/home/workspacecliente.css') }}" rel="stylesheet">
@endpush

@section('content')

    <div class="workspace-container">
        <h2>Bienvenido a Workspace Cliente</h2>
        <p>Contenido específico para clientes...</p>
    </div>

@endsection
