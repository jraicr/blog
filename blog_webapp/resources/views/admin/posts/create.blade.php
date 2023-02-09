@extends('adminlte::page')

@section('title', 'Code Rai')

@section('content_header')
    <h1>Crear nuevo post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

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

            <div class="mb-3 row">
                <div class="col">
                    <div class="image-wrapper">
                        <img id="picture"
                            src="https://cdn.pixabay.com/photo/2017/10/11/14/41/agriculture-2841234_960_720.jpg"
                            alt="">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'imagem que se mostraré en el post') !!}
                        {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

                        @error('file')
                            <span class="text-danger">{{ $message }} </span>
                        @enderror
                    </div>



                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati distinctio amet est. Cupiditate
                        sapiente praesentium vero deserunt quis sint aspernatur possimus laboriosam perferendis, eveniet,
                        laborum repellendus placeat doloribus natus provident.</p>
                </div>
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
