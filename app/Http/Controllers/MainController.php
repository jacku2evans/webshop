<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

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
    public function getCheckout()
    {
        if (!Session::has('cart')){
            return view('front.checkout');
        }


        $oldCart = Session::get('cart');

        $cart = new Cart ($oldCart);
        $total = $cart->totalPrice;
        return view('front.checkout', compact('total'));


    }
    public function postCheckout(Request $request)
    {
        if (!Session::has ('cart')){
            return redirect()->route('shoppingCart');

        }
        $oldCart = Session::get('cart');

        $cart = new Cart($oldCart);


        //Создаём экземпляр класса нашего заказа
        $order = new Order();


        //Создаём наш обЬект и записываем в БД
        $order->cart = serialize($cart);

        //Записываем адрес покупателя в БД
        $order->address = $request->input('address','address');
        //Записываем имя покупателя в БД
        $order->name = $request->input('name','name');

        //вызываем метод orders у модели User и сохраняем в БД
        Auth::user()->orders()->save($order);

        //Закрываем сессию
        Session::forget('cart');
        return redirect()->route('main')->with('success','Заказ оформлен');


    }
}
