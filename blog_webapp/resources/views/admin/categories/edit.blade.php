@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <h1>Editar Categoría</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($category, ['route' => ['admin.categories.update', $category], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca el nombre de la categoría',
                ]) !!}

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca el slug de la categoría',
                    'readonly',
                ]) !!}

                @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::submit('Actualizar Categoría', ['class' => 'btn btn-primary']) !!}


            {!! Form::close() !!}
        </div>
    </div>
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
