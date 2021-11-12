@extends('layouts.master')

@section('content')
@foreach ($products as $product)
      <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <small class="d-incline-block mb-2">
          @foreach($product->categories as $category)
            {{$category->name }}
          @endforeach
          </small>
          <h5 class="mb-0">{{ $product->title }}</h3>
          <div class="mb-1 text-muted">{{ $product->created_at->format('d/m/y') }}</div>
          <p class="mb-auto text-muted">{{$product->subtitle }}</p>
          <strong class="mb-auto font-weight-normal text-secondary">{{$product->getPrice() }}</strong>
          <a href="{{ route('products.show', $product->slug) }}" class="stretched-link btn btn-info">Voir l'article</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img class="w-50" src="/storage/products/{{ $product->image }}"/>
        </div>
      </div>
    </div>
    @endforeach
    {{ $products->appends(request()->input())->links() }}
@endsection