<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('front.front-index', compact('products'));
    }

    public function getAddToCart(Request $request, $id)
    {
        // получаем один продукт по id
        $product = Product::find($id);
        // получаем данные и записываем в сессиию
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        // вызываем экземпляр класса Cart
        $cart = new Cart($oldCart);
        // Вызываем метод add и добавляем продукт
        $cart->add($product, $product->id);

        // вызываем сессию и кладем туда наш продукт
        $request->session()->put('cart', $cart);

        // делаем var_dunp чтобы посмотреть что у нас туда поместилось
//        dd($request->session()->get('cart'));

        return redirect()->route('main');

    }

    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('front.cart', ['products' => null]);
        }

        // получаем данные и записываем в сессиию
        $oldCart = Session::get('cart');

        // вызываем экземпляр класса Cart
        $cart = new Cart($oldCart);

        // возвращаем шаблон корзины и передаем переменные
        return view('front.cart', [
            'products' => $cart->items,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);
    }
}
