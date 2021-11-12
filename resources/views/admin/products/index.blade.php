@extends('layouts.admin')

@include('layouts.admin-nav')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Modification(s) Produit</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('form.product')}}">Ajout contenu</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $message }}</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
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
                <td style="width: 10%">{{getPrice($product->price)}}</td>
                <td>{{$product->stock}}</td>
                <td>
                    <img class="w-50" src="/storage/products/{{ $product->image }}"/>
                </td>
                <td>#</td>
                <td>

                    <form action="" method="">

                        <a class="btn btn-info" href="{{ route('admin.products.show', $product->id) }}">Show</a>

                        <a class="btn btn-primary"
                            href="{{route('form.update.product', ['id' => $product->id])}}">Edit
                        </a>
                    </form>
                        <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                </td>

        </tr>
        @endforeach
    </table>

@endsection
