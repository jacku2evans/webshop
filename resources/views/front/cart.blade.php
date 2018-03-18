@extends('back.admin-index')

@section('content')
<ul class="list-group">
    <!-- Выводим списком добавленные позиции товаров -->
    @foreach($products as $product)

        <li class="list-group-item">
            {{ $product['item']['name'] }}
            <br>
            Цена: {{ $product['price'] }}
            <span class="badge">{{ $product['qty'] }}</span>
        </li>

    @endforeach
</ul>
<hr>
Общая количество: {{ $totalQty }}
<br>
Общая цена: {{ $totalPrice }}
<br>
<a href="{{route('checkout')}}">Оформить</a>
@endsection