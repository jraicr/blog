@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}

            {!! Form::hidden('user_id', auth()->user()->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Introduzca el nombre del post']) !!}

                @error('name')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Introduzca el slug del post',
                    'readonly',
                ]) !!}

                @error('slug')
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Categoría') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}

                @error('category_id')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>


            <div class="form-group">
                <p class="font-weight-bold">Etiquetas</p>

                @foreach ($tags as $tag)
                    <label class="mr-2">
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->name }}
                    </label>
                @endforeach

                @error('tags')
                    <br>
                    <small class="text-danger">{{ $message }} </small>
                @enderror

            </div>

            <div class="form-group">
                <p class="font-weight-bold">Estado</p>

                <label>
                    {!! Form::radio('status', 1, true) !!}
                    Borrador
                </label>

                <label>
                    {!! Form::radio('status', 2) !!}
                    Publicado
                </label>

                @error('status')
                    <br>
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('extract', 'Extracto') !!}
                {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

                @error('extract')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Cuerpo del post') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

                @error('body')
                    <small class="text-danger">{{ $message }} </small>
                @enderror
            </div>

            {!! Form::submit('Crear Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script>
        setupSlugify("#name", "#slug");

        ClassicEditor
            .create(document.querySelector('#extract'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#body'))
            .catch(error => {
                console.error(error);
            });

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
