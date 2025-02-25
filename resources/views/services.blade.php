@extends('layouts.myapp')

@section('title', $title)  <!-- Titre pour la page Services -->

@section('content')
    <h1>{{ $title }}</h1> <!-- Affiche le titre sur la page -->
    <p>Voici les services que nous offrons à nos clients.</p>
@endsection
