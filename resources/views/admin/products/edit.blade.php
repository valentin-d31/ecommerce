@extends('layouts.admin')


@php
  $categories = App\Category::all();
  $selectedCategories = [];

  foreach($product->categories as $category) {
    array_push($selectedCategories, $category->id);
  }
@endphp


@section('content')
    <form action="{{route('admin.products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

  <div class="form-group">
    <label for="exampleFormControlInput1">Produit</label>
    <input type="text" name ="title"class="form-control"  id="exampleFormControlInput1" placeholder="Titre" value="{{$product->title}}">
  </div>
  <div class="form-group">
 <label for="exampleFormControlInput1">sous titre</label>
 <input class="form-control"  type="text" name="subtitle" id="exampleFormControlInput1"  placeholder="sous titre" value="{{$product->subtitle}}">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Photo</label>
    <input class="form-control"  type="file" name="photo" id="exampleFormControlInput1">
  </div>

  <div class="form-group">
    <label for="categories">Catégories</label>
    <select class="form-control" name="categories[]" id="categories" multiple>
      @foreach($categories as $category)
      <option {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control"  name="description" id="exampleFormControlTextarea1" rows="3">{{$product->description}}</textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Prix</label>
    <input type="number" step="0.01"  name="price" class="form-control" id="exampleFormControlInput1" value="{{$product->price}}" placeholder="Prix">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Stock</label>
    <input type="number"  name="stock" step="0.01" class="form-control" id="exampleFormControlInput1" placeholder="Stock" value="{{$product->stock}}"> <br>
    <input type="hidden" value="{{$product->id}}" name="id" id="">
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
