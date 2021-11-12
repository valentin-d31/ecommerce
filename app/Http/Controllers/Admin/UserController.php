<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function show($id) {
        $user = User::find($id);
        return view('admin.users.show', [
            'user' => $user
        ]);
    }

    public function form() {
        return view('admin.users.add');
    }

    public function formUpdate($id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            return view('admin.users.edit')->with('user', $user);
        }
        return redirect()->back();
    }

    private function create(User $user, Request $request)
    {
        $user->name        = $request['name'];
        $user->email       = $request['email'];
        $user->password    = Hash::make($request['password']);
        $user->role        = $request['role'];

        $user->save();
    }

    public function store(Request $request)
    {
        $user = new User();

        $this->create($user, $request);
        return redirect()->route('admin.users.index')->with('success', 'Profil mis à jours');
        // @see : https://www.google.com/search?q=laravel+flash+alert&oq=laravel+flash+alert&aqs=chrome..69i57j0.3963j0j4&sourceid=chrome&ie=UTF-8
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role        = $request->input('role');

        $user->save();

        return redirect()->route('admin.users.index')
        ->with('success', 'Profil mis à jours');

    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
