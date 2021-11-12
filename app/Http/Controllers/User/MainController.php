<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {
        $orders = Auth::user()->orders;
        return view('user.index', [
            'orders' => $orders
        ]);
    }
}
