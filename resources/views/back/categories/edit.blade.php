@extends('back.admin-index')

@section('content')
    {!! Form::model($categories, array('route' => array('categories.update', $categories->id), 'method' => 'PUT')) !!}
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
    {{ Form::submit('Редактировать категорию', ['class' => 'btn btn-success']) }}

    {!! Form::close() !!}
@endsection