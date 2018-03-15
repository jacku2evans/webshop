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
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <ul class="list-inline">
                                <li><a href="{{ route('categories.edit', [$category->id]) }}" class="btn btn-primary"><span class="fa fa-edit"></span> Редактировать</a></li>
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id]]) !!}
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