@extends('back.admin-index')

@section('content')
    {!! Form::model($products, array('route' => array('products.update', $products->id), 'method' => 'PUT')) !!}
    <div class="form-group">
        {{ Form::label('name', 'Product name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('price', 'Product price') }}
        {{ Form::text('price', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('slug', 'Product slug') }}
        {{ Form::text('slug', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('content', 'Product content') }}
        {{ Form::textarea('content', null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        <div class="radio">
            <label>
                {{ Form::radio('active', '1', true) }}
                is active
            </label>
        </div>
        <div class="radio">
            <label>
                {{ Form::radio('active', '0') }}
                is no active
            </label>
        </div>
        <div class="form-group">
            {{ Form::label('category_id', 'Product category') }}
            {{ Form::select('category_id', $categories, null, ['class'=>'form-control']) }}
        </div>
    {{ Form::submit('Редактировать продукт', ['class' => 'btn btn-success']) }}

    {!! Form::close() !!}
@endsection