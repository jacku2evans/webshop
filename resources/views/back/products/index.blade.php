@extends('back.admin-index')

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                    <th>Категория</th>
                    <th>Альяс</th>
                    <th>Описание</th>
                    <th>Управление</th>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>$ {{ $product->price }}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-primary"><span class="fa fa-edit"></span> Редактировать</a></li>
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id]]) !!}
                                    {!! Form::submit('Удалить', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection