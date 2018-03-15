@extends('back.admin-index')

@section('content')
    {!! Form::open(['route' => 'categories.store']) !!}
    <div class="form-group">
        {{ Form::label('name', 'Category name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('slug', 'Category slug') }}
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Category description') }}
        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
    </div>
    {{ Form::submit('Создать категорию', ['class' => 'btn btn-success']) }}

    {!! Form::close() !!}
@endsection