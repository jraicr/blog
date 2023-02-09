@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}

            @include('admin.tags.partials.form')

            {!! Form::submit('Actualizar etiqueta', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    setupSlugify("#name", "#slug");

    function setupSlugify(inputFieldID, slugFieldID) {
        let inputElements = getInputNodesFromID(inputFieldID, slugFieldID); // Obtenemos nodos del input
        setupEventHandlers(inputElements.nameField, inputElements.slugField);
    }

    function setupEventHandlers(inputTextFieldElement, inputSlugFieldElement) {
        inputTextFieldElement.addEventListener('input', (e) => slugifyField(e, inputSlugFieldElement));
    }

    function slugifyField(e, inputSlugFieldElement) {
        let str = e.target.value;
        str = str
            .toString()
            .normalize('NFD') // divide una letra acentuada en la letra base y la misma acentuada
            .replace(/[\u0300-\u036f]/g, '') // borra toda las letras acentuadas previas
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9 ]/g, '') // Elimina caracteres que no son letras, números y espacios, para reemplazarlos
            .replace(/\s+/g, '-');

        // Finalmente modificamos el valor del campo de texto
        inputSlugFieldElement.value = str;
    }

    function getInputNodesFromID(inputFieldID, slugFieldId) {
        let nameField = document.querySelector(inputFieldID);
        let slugField = document.querySelector(slugFieldId);

        return {
            nameField,
            slugField
        };
    }
</script>
@stop
