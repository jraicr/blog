@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <h1>Editar post</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($post, [
                'route' => ['admin.posts.update', $post],
                'autocomplete' => 'off',
                'files' => true,
                'method' => 'put',
            ]) !!}

            {{-- Plantilla de formulario de datos de un post  --}}
            @include('admin.posts.partials.form')

            {!! Form::submit('Actualizar Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script>
        // Previsualización de imagen
        document.getElementById("file").addEventListener('change', changeImage);

        function changeImage(event) {
            let file = event.target.files[0];
            let reader = new FileReader();

            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result)
            };
            reader.readAsDataURL(file);
        }

        // CKEditor en los textarea de extracto y body
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


        // "Slugifica" del título del post
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
