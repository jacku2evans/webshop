@extends ('black.admin-index)

@section('content')
    <h1>{{$total}}</h1>

    <form action="{{route('checkout')}}" method="POST">
        <div class="form-group">
        <input type="name" name="name" class="form-control">
        </div>
        <div class="form-group">
        <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            {{csrf_field()}}
        <button type="submit" class="btn btn-success">Оформить</button>
        </div>
    </form>

@endsection