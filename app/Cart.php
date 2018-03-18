<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends  Model
{
    // Определяем стандартные свойства
    public $items = null; // продукты
    public $totalQty = 0; // общее колличество товаров
    public $totalPrice = 0; // общая цена

    // Создаем конструктор
    public function __construct($oldCart) // сюда записываем данные которые придут к нам от пользователя
    {
        if ($oldCart) {
            $this->items = $oldCart->items; // заменяем дефолтные значения
            $this->totalQty = $oldCart->totalQty; // заменяем дефолтные значения
            $this->totalPrice = $oldCart->totalPrice; // заменяем дефолтные значения
        }
    }

    // метод добавления продукта в сессию
    public function add($item, $id)
    {
        // создаем массив где будем хранить наши добавленные продукты
        $storedItem = [
            'qty' => 0, // колличество
            'price' => $item->price, // цена
            'item' => $item // сам продукт
        ];
        // делаем проверку и если там есть продукты то проходимся по массиву и заносим данные
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        // Добавление продукта
        $storedItem['qty']++;

        // увеличение цены на колличество
        $storedItem['price'] = $item->price * $storedItem['qty'];

        $this->items[$id] = $storedItem;

        // Общее колличество товаров
        $this->totalQty++;

        // Общую цену увеличиваем
        // прибавляем цену к цене
        $this->totalPrice += $item->price;

    }
    public function reduceByOne($id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -=$this->items[$id]['items']['price'];
        $this->totalQty--;
        if ($this->items[$id]['qty']<=0){
            unset($this->items[$id]);
        }
    }
    public function removeItems($id)
    {
        $this->totalQty -=$this->items[$id]['qty'];
        $this->totalPrice -=$this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
