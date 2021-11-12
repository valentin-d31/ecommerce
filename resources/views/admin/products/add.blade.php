@extends('layouts.admin')

@php
  $categories = App\Category::all();
@endphp

@section('content')
    <form action="{{route('admin.products.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="form-group">
    <label for="exampleFormControlInput1">Produit</label>
    <input type="text" name ="title"class="form-control"  id="exampleFormControlInput1">
  </div>
  <div class="form-group">
 <label for="exampleFormControlInput1">sous titre</label>
  <input class="form-control"  type="text" name="subtitle" id="exampleFormControlInput1">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Photo</label>
    <input class="form-control"  type="file" name="photo" id="exampleFormControlInput1">
  </div>

  <div class="form-group">
    <label for="categories">Catégories</label>
    <select class="form-control" name="categories[]" id="categories" multiple>
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control"  name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Prix</label>
    <input type="number" step="0.01"  name="price" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Stock</label>
    <input type="number"  name="stock" step="0.01" class="form-control" id="exampleFormControlInput1">
  </div>

    <button type="submit">Valider</button>
    @if(session()->has('products'))
    <div class="alert alert-success" role="alert">
        {{ session()->get('products')}}
    </div>

    @endif


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

