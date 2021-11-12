@extends('layouts.master')

@section('content')
  <div class="col-md-12">
    <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
      <div class="col p-3 d-flex flex-column position-static">
      <muted class="d-inline-block mb-2 text-info">
      <div class="badge badge-pill badge-info">{{$stock}}</div>
          @foreach ($product->categories as $category)
              {{ $category->name }}{{ $loop->last ? '' : ', '}}
          @endforeach
        </muted>
        <h5 class="mb-0">{{ $product->title }}</h5>
        <hr>
        <p class="mb-auto text-muted">{{ $product->description }}</p>
        <strong class="m4-auto font-weight-normal text-secondary">{{ $product->getPrice() }}</strong>
        @if($stock === 'Disponible')
        <form action="{{ route('cart.store') }}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button type="submit" class="btn btn-success"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Ajouter au panier</button>
        </form>
        @endif
      </div>
      <div class="col-auto d-none d-lg-block">
        <img class="w-50" src="/storage/products/{{ $product->image }}"/>
      </div>
    </div>
  </div>
@endsection