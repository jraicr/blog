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
            @isset ($post->image)
                <img id="picture" src="{{ Storage::url($post->image->url) }}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2017/10/11/14/41/agriculture-2841234_960_720.jpg"
                    alt="">
            @endisset
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'imagen que se mostraré en el post') !!}
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
