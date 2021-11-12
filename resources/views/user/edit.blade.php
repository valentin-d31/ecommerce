@extends('layouts.master')


@section('content')
    <form action="{{route('user.update')}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Nom</label>
            <input type="text" id="name" value={{ $user->name }} name="name" class="form-control" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="mail">Adresse mail:</label>
            <input type="email" id="email" value={{ $user->email }}  name="email" class="form-control" id="exampleFormControlInput1">
          </div>

<button type="submit">Valider</button>


    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection