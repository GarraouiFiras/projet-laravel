@extends('layouts.myapp')

@section('title', $title)  <!-- Titre pour la page À propos -->

@section('content')
    <h1>{{ $title }}</h1> <!-- Affiche le titre sur la page -->
    <p>Nous sommes une entreprise dédiée à la qualité et à l'innovation.</p>
@endsection
