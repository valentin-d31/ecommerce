<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function edit() {
        $user = Auth::user();
        return view('user.edit', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();
        return redirect()->route('products.index')->with('success', 'Vos informations ont bien été mises à jour.');
    }
    
}
