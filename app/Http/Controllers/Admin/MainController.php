<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{

    public function index() {
        $orders = Order::all();
        return view('admin.home.index', [
            'orders' => $orders
        ]);
    }
}
