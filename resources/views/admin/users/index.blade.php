@extends('layouts.admin')

@include('layouts.admin-nav')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification(s) Utilisateur</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('form.user') }}">Ajouter un nouvel utilisateur</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nom</th>
            <th>Adresse mail</th>
            <th>Date de naissance</th>
            <th>Photo</th>
            <th>Produit(s)</th>
        
            <th width="250px">Action</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>

                <form action="" method="">

                    <a class="btn btn-info" href="{{ route('admin.users.show', $user->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('form.update.user', $user->id) }}">Edit</a>
                </form>
                <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@stop
