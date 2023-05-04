@extends('layouts.app')

@section('titulo')
    Página principal
@endsection

@section('contenido')
    {{-- pasando la variabel posts a la vista listar-post en el constructo del archivo
        ListarPost debemos pasar la variable --}}
    {{-- <x-listar-post :posts="$posts" /> --}}
    <x-listar-post :posts="$posts" /> 
@endsection
