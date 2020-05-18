@extends('layout.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification(s)</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="#">Ajout contenu</a>
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
            <th>Description</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Photo</th>
            <th>Code d'activation</th>
        
            <th width="250px">Action</th>
        </tr>

        <tr>
        @foreach ($products as $product)

            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->price}}</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
            <td>

                <form action="# method="POST">

                    <a class="btn btn-info" href="#">Show</a>
    
                    <a class="btn btn-primary" href="#">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection