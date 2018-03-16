@extends('back.admin-index')

@section('content')
<ul class="list-group">
    <!-- Выводим списком добавленные позиции товаров -->
    @foreach($products as $product)

        <li class="list-group-item">
            {{ $product['item']['name'] }}
            <span class="badge">{{ $product['qty'] }}</span>
        </li>

    @endforeach
</ul>
<hr>
{{ $totalQty }}
@endsection