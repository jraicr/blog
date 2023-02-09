@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <a class="float-right btn btn-secondary btn-sm" href="{{route('admin.posts.create')}}">Nuevo Post </a>
    <h1>Listado de posts</h1>
@stop

@section('content')
    @livewire('admin.posts-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hola!');
    </script>
@stop
