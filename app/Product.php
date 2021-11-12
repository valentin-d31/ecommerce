<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Facades\Cart;

class Product extends Model
{
    protected $fillable = ['stock'];
    
    public function getprice()
    {
        $price = $this->price / 100;

        return number_format($price, 2, ',', ' ') . ' €';
    }


    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

public function updateStock()
    {
        foreach(Cart::content() as $item) {
            $product = Product::find($item->model->id);

            $product->update(['stock' => $product->stock - $item->qty]);
        }
    }
}