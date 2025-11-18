@extends('home.layouts.app')

@section('title', 'Inicio | Freeland')
@section('menu-inicio', 'active')

@push('styles')
<link href="{{ asset('css/home/inicio.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="share-card">
  <div class="share-header">
    <img src="https://ui-avatars.com/api/?name=Juan&background=ededed&color=363636" class="avatar-large" alt="Juan" />
    <input type="text" class="share-input" placeholder="¿Qué quieres compartir, Juan?" disabled />
  </div>
  <div class="share-actions">
    <button class="share-action"><span class="share-icon">&#128188;</span> Proyecto</button>
    <button class="share-action"><span class="share-icon">&#127942;</span> Logro</button>
    <button class="share-action"><span class="share-icon">&#128101;</span> Colaboración</button>
    <button class="share-action"><span class="share-icon">&#128247;</span> Foto</button>
  </div>
</div>

<div class="no-publications">
    <div class="empty-icon">&#128230;</div>
    <p>No hay publicaciones aún</p>
    <span>Sé el primero en compartir algo...</span>
</div>
@endsection
